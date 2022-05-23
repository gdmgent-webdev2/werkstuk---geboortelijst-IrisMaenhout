<?php

namespace App\Http\Controllers;

use App\Models\Babylist;
use App\Models\Favorite_Product;
use App\Models\Product;
use Illuminate\Http\Request;

class OverviewBabylist extends Controller
{
    public function Show($name)
    {
        $explode_name = explode( '-', $name);
        $first_name = array_shift($explode_name);

        $babylists = Babylist::where('first_name_child', '=', $first_name)->get()->toArray();

        if($babylists == []){
            abort(404);
        };

        $products_list = [];

        foreach ($babylists as $babylist) {
            if(explode( ' ', strtolower($babylist['last_name_child'])) == $explode_name){
                $favorite_products = Favorite_Product::where('babylist_id', '=', $babylist['id'])->get();
                foreach ($favorite_products as $favorite_product) {
                    $products = Product::where('id', '=', $favorite_product->product_id)->get()->toArray();
                    array_push($products_list, $products);
                }

            }

        }

        return view('overview-babylist', [
            "babylist" => $babylist,
            "favorite_products" => $favorite_products,
            "products" => $products_list,
        ]);


    }


    public function Delete()
    {
        $product_id = intval($_GET['product-id']);
        $babylist_id = intval($_GET['babylist-id']);

        Favorite_Product::where('product_id', '=', $product_id)->where('babylist_id', '=' , $babylist_id)->first()->delete();

        return back();
    }
}
