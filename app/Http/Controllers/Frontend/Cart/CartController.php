<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Cart;
use App\Exceptions\CustomException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Auth;
use DB;

class CartController extends Controller
{
    //
    public function index()
    {
        return view('Frontend.cart');
    }

    /**
     * Store Or Update products in cart
     * Request needs to have product_id and quantity
     * @param Request $request
     * @return Response
     */
    public function storeOrUpdate(Request $request)
    {

        try {
            $product = Product::whereId($request->product_id)->firstOrFail();
            if ($request->quantity <= 0) {
                throw new CustomException("Quantity should be greater than 1");
            }

            $user = Auth::guard('customer')->user();
            $cart = $user->cart;
            if (!$cart) {
                $cart = (new Cart())->getCartForUser($user);
            }
            DB::beginTransaction();
            $total = $product->price * $request->quantity;
            $cart->update(['total' => $total]);
            $message = "Product added to cart";
            if ($cart->isProductInCart($product->id)) {
                $message = "Product updated";
            }
            $cart->createOrUpdateProduct($product, $request->quantity);
            DB::commit();
            $cart->updateTotalPrice();
            return redirect()->back()->withErrors(['alert-success' => $message]);
        } catch (CustomException $e) {
            return redirect()->back()->withErrors(['alert-danger' => $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['alert-danger' => "Product not found"]);
        }
    }

    /**
    * Delete cart
    * @return void
    */
    public function destroyCartProduct(Request $request)
    {
        try {
            $user = Auth::guard('customer')->user();
            $cart = $user->cart;
            $product = Product::findOrFail($request->product_id);
            $cart->removeProduct($product);
            $cart->updateTotalPrice();
            return redirect()->back()->withErrors(['alert-success' => "Product was removed successfully"]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['alert-success' => "Product was removed successfully"]);
        }
    }

    /**
     * Delete cart
     * @return void
     */
    public function destroy()
    {
        request()->user()->cart()->delete();
        return redirect()->back()->withErrors(['alert-success' => "Cart was deleted successfully"]);
    }


    /**
     * Ajax cart request
     * @param Request $request
     * @return
     */
    public function ajax(Request $request)
    {
        $cart  = \Auth::guard('customer')->user()->cart;

        foreach ($request->product as $product => $quantity) {
            $product = Product::whereId($product)->first();
            $cart->createOrUpdateProduct($product, $quantity);
        }
        $cart->updateTotalPrice();

        $cart = Cart::whereId($cart->id)->first();
        return response()->json([
            'total' => $cart->total
        ], 200);
    }
}
