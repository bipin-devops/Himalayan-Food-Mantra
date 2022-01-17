<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(Order $order)
    {
        $this->pageTitle = "Order";
        $this->model = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $title = $this->pageTitle;
        $input = $request->all();
        $route = 'order.';
        $permission = 'order.order.';
        $data = $this->model->getAllData($request->all());

        return view('Admin.order.index', compact('title', 'data', 'route', 'input', 'permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        try {
            $input = $request->all();
            $route = 'order.';
            $permission = 'order.order.';
            $data = $this->model->findOrFail($id);
            $title = "Customers Order";
            $allStatus = Order::$allOrderStauts;
            return view('Admin.order.show', compact('title', 'data', 'route', 'input', 'permission', 'allStatus'));
        } catch (\Exception $e) {
            return redirect()->to('/system/order')->withErrors(['alert-danger' => "Order not found"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $input = $request->all();
            $data = $this->model->findOrFail($id);
            $paymentStatus = 'unpaid';
            if ($input['status'] == 'pickedUp') {
                $paymentStatus = 'paid';
            }
            $data->update([
                'status' => $input['status'],
                'payment_status' =>$paymentStatus,
            ]);

            $data->orderTransaction()->update(['payment_status' => $paymentStatus]);
            return redirect()->back()->withErrors(['alert-success' => "Order updated"]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['alert-danger' => "Order not found"])->withInput(\Input::all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function countOrder(Request $request)
    {
        $status = $request->get('status');

        return response()->json([
            "count" => Order::whereStatus($status)->count()
        ]);
    }
}
