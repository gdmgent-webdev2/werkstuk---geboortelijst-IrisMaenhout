<?php

namespace App\Http\Controllers;

use App\Models\Sub_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailProductController extends Controller
{
    public function Show($id)
    {
        $product = DB::table('products')->where('id', '=' ,$id)->get()->toArray();

        if($product == []){
            abort(404);
        }else{
            $sub_category = Sub_Category::where('id', '=', $product[0]->sub_category_id)->get();

            return view('detail-product', [
                "product" => $product,
                "shop" => $sub_category[0]->shop,
            ]);
        }

    }
}
