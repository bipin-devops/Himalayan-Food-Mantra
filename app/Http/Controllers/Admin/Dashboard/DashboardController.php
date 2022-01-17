<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Category;
use App\Customer;
use App\Http\Controllers\Controller;
use App\News;
use App\Order;
use App\Product;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $startindDate = Carbon::yesterday()->setTime(0, 00, 00)->toDateTimeString();
        $endingDate = Carbon::yesterday()->setTime(23, 59, 59)->toDateTimeString();
        $data = [
            'productCount' => Product::count(),
            'activeProductCount' => Product::whereStatus('Active')->count(),
            'categoryCount' => Category::count(),
            'activeCategoryCount' => Category::whereStatus('Active')->count(),
            'newsCount' => News::count(),
            'todayNewsCount' => News::where('created_at', '>=', Carbon::now())->count(),
            'orderCount' => Order::count(),
            'allStatus' => Order::$allOrderStauts,
            'allColour' => Order::$allColourStauts,
            'latestOrder' => Order::latest()->take(5)->paginate(),

            'totalEarning' => Order::where('status', '!=', 'cancelled')->where('payment_status', 'paid')->sum('total'),
            'todayEarning' => Order::where('status', '=', 'pickedUp')->where('created_at', '>', Carbon::today()->setTime(0, 00, 00)->toDateTimeString())->sum('total'),
            'yesterdayEarning' => Order::where('status', '!=', 'cancelled')->whereBetween('created_at', [$startindDate, $endingDate])->where('payment_status', 'paid')->sum('total'),
            'orderStatusCount' => [],
            'orderPieChartData' => [
                "paid" => Order::wherePaymentStatus('paid')->count(),
                "unpaid" => Order::wherePaymentStatus('unpaid')->count(),
                "pendingOrders" => Order::wherePaymentStatus('unpaid')->whereNotIn('status', ['cancelled', 'pickedUp'])->count(),
            ],

        ];

        foreach (Order::$allOrderStauts as $name => $title) {
            $data['orderStatusCount'][$name] = Order::whereStatus($name)->count();
        }
        $topUsers = collect(DB::select(DB::raw('SELECT user_id as user_id, COUNT(user_id) AS "total"  FROM orders GROUP BY user_id ORDER BY "total" DESC LIMIT 6')))->pluck("total", "user_id")->toArray();
        $data['topUsers'] = Customer::whereIn('id', array_keys($topUsers))->get()->map(function ($item) use ($topUsers) {
            $item->totalOrders = $topUsers[$item->id];
            $item->totalOrderPrice = $item->activeOrders()->sum('total');
            return $item;
        });

        $topCategory = collect(DB::select(DB::raw('SELECT prod.category_id as cat_id, COUNT(prod.category_id) AS "total"  FROM order_products op JOIN products prod ON prod.id=product_id GROUP BY cat_id ORDER BY "total" DESC LIMIT 6')))->pluck("total", "cat_id")->toArray();
        $data['categories'] = Category::whereIn('id', array_keys($topCategory))->get()->map(function ($item) use ($topCategory) {
            $item->total = $topCategory[$item->id];
            return $item;
        });

        $topProducts = collect(DB::select(DB::raw('SELECT product_id, COUNT(product_id) AS total  FROM order_products GROUP BY product_id ORDER BY total DESC LIMIT 6')))->pluck("total", "product_id")->toArray();
        $data['products'] = Product::whereIn('id', array_keys($topProducts))->with('category')->get()->map(function ($item) use ($topProducts) {
            $item->total = $topProducts[$item->id];
            return $item;
        });

        return view('Admin.dashboard.index', $data);
    }

    public function retrieveChartData()
    {
        return response()->json([
            'earning' => $this->getWeeklyEarningChartData(),
            'registration' => $this->getWeeklyUserRegistrationChartData(),
        ], 200);
    }

    protected function getWeeklyEarningChartData()
    {
        $weeklyEarningChart = DB::table('orders')
            ->select([
                DB::raw('SUM(total) as total'),
                DB::raw('DATE(created_at) as date'),
            ])
            ->whereRaw('DATE(created_at) > ?', [Carbon::now()->subDays(6)->format('Y-m-d')])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->whereStatus('pickedUp')
            ->get()
            ->pluck('total', 'date')
            ->toArray();

        $dateData = [];
        $period = CarbonPeriod::create(Carbon::now()->subDays(6)->format('Y-m-d'), Carbon::now());
        foreach ($period as $date) {
            $dateData[$date->format('M-d')] = isset($weeklyEarningChart[$date->format('Y-m-d')]) ? (float) round($weeklyEarningChart[$date->format('Y-m-d')], 2) : 0;
        }
        return $dateData;
    }

    protected function getWeeklyUserRegistrationChartData()
    {
        $weeklyRegistrationChart = DB::table('customers')
            ->select([
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(id) AS total'),
            ])
            ->whereRaw('DATE(created_at) > ?', [Carbon::now()->subDays(6)->format('Y-m-d')])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()
            ->pluck('total', 'date')
            ->toArray();

        $dateData = [];
        $period = CarbonPeriod::create(Carbon::now()->subDays(6)->format('Y-m-d'), Carbon::now());
        foreach ($period as $date) {
            $dateData[$date->format('M-d')] = isset($weeklyRegistrationChart[$date->format('Y-m-d')]) ? (int) $weeklyRegistrationChart[$date->format('Y-m-d')] : 0;
        }

        return $dateData;
    }
}
