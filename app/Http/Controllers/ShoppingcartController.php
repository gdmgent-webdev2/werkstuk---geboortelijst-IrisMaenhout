<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;

class ShoppingcartController extends Controller
{
    public function Show()
    {
        $products_shoppingcart = Cart::session(1)->getContent();
        $total = Cart::session(1)->getTotal();

        return view('shoppingcart', [
            "products_shoppingcart" => $products_shoppingcart,
            "total" => $total,
        ]);
    }

    public function DeleteItem()
    {
        $product_id = $_POST['product-id'];
        Cart::session(1)->remove($product_id);

        return redirect()->back();
    }
}
