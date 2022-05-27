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
        // Try to find a better way
        dd('stop');




        $user_id = auth()->user()->id;
        $babylist = Babylist::where('user_id', '=', $user_id)->orderBy('id', 'desc')->first();
        $product_id = $_GET['id-product'];
        $saved_products = new Favorite_Product;
        $saved_products->user_id = $user_id;
        $saved_products->babylist_id = $babylist->id;
        $saved_products->product_id = $product_id;
        $saved_products->status = 'not bought';
        $saved_products->save();

        return back();
    }
}
