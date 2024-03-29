<?php

namespace App\Http\Controllers;

use App\Models\Babylist;
use App\Models\Favorite_Product;
use App\Models\Product;
use Illuminate\Http\Request;

class SaveProductInBabylistController extends Controller
{
    public function Store()
    {
        $user_id = auth()->user()->id;

        if(isset($_GET['babylist-id'])){
            $babylist_id = $_GET['babylist-id'];
            $babylist = Babylist::where('id', '=', $babylist_id)->first();
        }else{
            $babylist = Babylist::where('user_id', '=', $user_id)->orderBy('id', 'desc')->first();
        }

        $product_id = $_GET['product-id'];
        $saved_products = new Favorite_Product;
        $saved_products->user_id = $user_id;
        $saved_products->babylist_id = $babylist->id;
        $saved_products->product_id = $product_id;
        $saved_products->status = 'not bought';
        $saved_products->save();

        return back();
    }
}
