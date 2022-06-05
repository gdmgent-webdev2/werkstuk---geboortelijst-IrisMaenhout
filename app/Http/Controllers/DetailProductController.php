<?php

namespace App\Http\Controllers;

use App\Models\Favorite_Product;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailProductController extends Controller
{
    public function Show($id)
    {
        session_start();
        $product = Product::where('id', '=' ,$id)->get()->first();

        if($product == null){
            abort(404);
        }else{
            $sub_category = Sub_Category::where('id', '=', $product->sub_category_id)->get();
            $favorite_product = Favorite_Product::where('babylist_id', '=', $_SESSION['babylist-id'])->where('product_id', '=', $id)->get()->first();
            $order = Order::where('babylist_id', '=', $_SESSION['babylist-id'])->where('product_id', '=', $id)->get()->first();

            return view('detail-product', [
                "product" => $product,
                "shop" => $sub_category[0]->shop,
                "babylist_id" => $_SESSION['babylist-id'],
                "favorite_product" => $favorite_product,
                "order" => $order,
            ]);
        }

    }
}
