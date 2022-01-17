<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Http\Controllers\Controller;
use App\OrderTransaction;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $user = Auth::guard('customer')->user();
        $cartData = Cart::where('user_id', $user->id)->first();
        if (is_null($cartData)) {
            return redirect()->to('/')->withErrors(['alert-danger' => "Cart is empty"]);
        }
        return view('Frontend.cart');
    }

    public function checkout()
    {
        $user = Auth::guard('customer')->user();
        $cartData = Cart::where('user_id', $user->id)->first();
        if (is_null($cartData)) {
            return redirect()->to('/')->withErrors(['alert-danger' => "Cart is empty"]);
        }
        $productData = $cartData->getCartProductAttribute() ;
        $paymentMethods = OrderTransaction::$paymentMethods;
        return view('Frontend.checkout', compact('user', 'cartData', 'productData', 'paymentMethods'));
    }

    public function thankyou()
    {
        return view('Frontend.thankyou');
    }
}
