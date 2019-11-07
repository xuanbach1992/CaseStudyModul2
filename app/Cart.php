<?php


namespace App;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class Cart
{

    public $products = null;
    public $totalPrice = 0;
    public $totalProduct = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->products = $oldCart->products;
            $this->totalPrice = $oldCart->totalPrice;
            $this->totalProduct = $oldCart->totalProduct;
        }
    }

    public function add($product)
    {
        $storeProduct = [
            "product" => $product,
            "price" => 0,
            "totalQty" => 0,
        ];
        if ($this->products) {
            if (array_key_exists($product->id, $this->products)) {
                $storeProduct = $this->products[$product->id];
                $this->totalProduct = count($this->products);
            } else {
                $this->totalProduct++;
            }
        } else {
            $this->totalProduct++;
        }
        $storeProduct["totalQty"]++;
        $storeProduct["price"] = $product->price * $storeProduct["totalQty"];
        $this->products[$product->id] = $storeProduct;
        $this->totalPrice += $product->price;
    }

    function removeProduct($id)
    {
        if ($this->products) {
            $productsIntoCart = $this->products;
            if (array_key_exists($id, $productsIntoCart)) {
                $priceProDelete = $productsIntoCart[$id]['price'];
                $this->totalPrice -= $priceProDelete;
                $this->totalProduct--;
                unset($productsIntoCart[$id]);
                $this->products = $productsIntoCart;
            }
        }
    }

    public function plus($id)
    {
        if ($this->products) {
            $productsIntoCart = $this->products;

            if (array_key_exists($id, $productsIntoCart)) {
                $productsUpdate = $productsIntoCart[$id];
                $pricePlus = $productsUpdate['product']->price;
                $productsIntoCart[$id]['totalQty']++;
                $productsIntoCart[$id]['price'] += $pricePlus;
                $this->totalPrice += $pricePlus;
                $this->products = $productsIntoCart;
            }
        }
    }

    public function subtraction($id)
    {
        if ($this->products) {
            $productsIntoCart = $this->products;

            if (array_key_exists($id, $productsIntoCart)) {
                $productsUpdate = $productsIntoCart[$id];
                $priceSub = $productsUpdate['product']->price;
                if ($productsIntoCart[$id]['totalQty'] > 1) {
                    $productsIntoCart[$id]['totalQty']--;
                    $productsIntoCart[$id]['price'] -= $priceSub;
                    $this->totalPrice -= $priceSub;
                    $this->products = $productsIntoCart;
                } else {
                    $this->removeProduct($id);
                    Session::flash('delete_error', 'Bạn chưa mua sản phẩm nào');
                }
            }
        }

    }
}
