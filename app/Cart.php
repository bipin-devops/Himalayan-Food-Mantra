<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Cart Attributes
 * $cart->totalProduct => Gives total product count attribute
 * $cart->cartProduct => Gives all product model with quantity
 */
class Cart extends Model
{
    //
    protected $fillable = ['reference_no','total','products','user_id'];

    // Cast to array
    protected $casts = [ 'products' => 'array' ];


    /**
     * Check if the given product is in cart
     * @param integer $productId
     * @return bool
     */
    public function isProductInCart(int $productId) : bool
    {
        $products = collect($this->products)->pluck('product_id')->toArray();
        return in_array($productId, $products);
    }


    /**
     * Total products count in cart
     * @return int
     */
    public function getTotalProductAttribute() : int
    {
        return count($this->products);
    }


    /**
     * Total products count in cart
     * @return int
     */
    public function getCartProductAttribute() : Collection
    {
        if (is_null($this)){
            return collect([]);
        }
        $products = collect($this->products)->pluck('product_id')->toArray();
        if (count($products)) {
            $productWithQuantity = [];
            foreach ($this->products as $key => $value) {
                $productWithQuantity[$value['product_id']] = $value['quantity'];
            }
            return Product::whereIn('id', $products)->get()->map(function ($item) use ($productWithQuantity) {
                $item->quantity = (int) $productWithQuantity[$item->id];
                $item->total = $item->quantity * $item->price;
                return $item;
            });
        }
        return collect([]);
    }

    public function updateTotalPrice()
    {
        $this->update(['total' => $this->cartProduct->sum('total')]);
        return $this;
    }

    /**
     * Create product if not in cart else update it
     * @param Product $productId Product to add to cart
     * @param int $quantity Quantity of product
     * @return self
     */
    public function createOrUpdateProduct(Product $product, $quantity) : self
    {
        if ($this->isProductInCart($product->id)) {
            $products = array_map(function ($item) use ($product, $quantity) {
                if ($item['product_id'] == $product->id) {
                    $item['quantity'] = $quantity;
                }
                return $item;
            }, $this->products);
        } else {
            $products = $this->products;
            $products[] = [
                'product_id' => $product->id,
                'quantity' => $quantity
            ];
        }
        $this->update([ 'products' => $products ]);
        $this->products = $products;
        return $this;
    }

    /**
     * Remove product from cart
     * @param Product $product
     * @return self
     */
    public function removeProduct(Product $product) : self
    {
        if ($this->isProductInCart($product->id)) {
            $products = array_filter($this->products, function ($item) use ($product) {
                return !($item['product_id'] == $product->id);
            });
            $this->products = $products;
            $this->update(['products' => $products]);
        }
        return $this;
    }


    public function getCartForUser($user)
    {
        if ($user->cart) {
            return $user->cart;
        }

        return self::create([
            'reference_no' => md5(uniqid(rand(0, 999999999), true)),
            'total' => 0,
            'products' => [],
            'user_id' => $user->id
        ]);
    }
}
