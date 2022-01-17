<?php

namespace App\Http\Controllers\Frontend\Order;

use App\Exceptions\CustomException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\OrderRequest;
use App\Order;
use App\OrderTransaction;
use Auth;
use Carbon\Carbon;
use DB;

class OrderController extends Controller
{


    /**
    * Store Or Update products in cart
    * @param Request $request
    * @return Response
    */
    public function store(OrderRequest $request)
    {
        try {
            $user = Auth::guard('customer')->user();
            $cart = $user->cart;
            DB::beginTransaction();

            $order = Order::create([
                'total' => $cart->total,
                'reference_no' => substr(hash('sha256', mt_rand(0, Carbon::now()->timestamp)), 0, 12),
                'user_id' => $user->id,
                'note' => $request->note ?? "",
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'address' => $request->address,
                'phone'=> $request->phone
            ]);

            $allPaymentMethods = OrderTransaction::$paymentMethods;

            $order->orderTransaction()->create([
                'title' => $allPaymentMethods[$request->payment_method],
                'total' => $cart->total
            ]);

            $this->addProductToOrder($cart->cartProduct, $order);
            $cart->delete();
            DB::commit();
            $request->session()->put('order_id', $order->id);
            return redirect()->to('/checkout/successfull')->withErrors(['alert-success' => "Ordered Successfull"]);
        } catch (CustomException $e) {
            return redirect()->back()->withErrors(['alert-danger' => $e->getMessage()]);
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['alert-danger' => "Product not found"]);
        }
    }

    /**
     * Order success page
     * @return void
     */
    public function success(Request $request)
    {
        $currentOrder = $request->session()->get('order_id', null);
        if ($currentOrder) {
            $order = Order::whereId($currentOrder)->first();
            return view('Frontend.thankyou', [ 'order' => $order]);
        }
        $request->session()->forget('order_id');
        return redirect()->to('/');
    }


    protected function addProductToOrder($cartProduct, $order)
    {
        foreach ($cartProduct as $product) {
            $order->orderProduct()->create([
                'product_id' => $product->id,
                'quantity' => $product->quantity,
                'unit_price' => $product->price,
                'title' => $product->title
            ]);
        }
        return true;
    }
}
