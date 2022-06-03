<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ShopController extends Controller
{

    public function index() {

        // $category = Category::where('slug', $category)->firstOrFail();

        View::share('categories', Category::all());
        View::share('sub_categories', Sub_Category::all());

        if(isset($_GET['sub-category'])){

            $selected = $_GET['sub-category'];
            View::share('selected', $selected);

            // Get products by their sub catrgory
            $filterd_products = [];
            foreach($selected as $selected_sub_cat){
                $get_sub_categorie = DB::table('sub_categories')->where('name', '=' ,$selected_sub_cat)->get();

                $products = DB::table('products')->where('sub_category_id', '=' ,$get_sub_categorie['0']->id)->get()->toArray();
                array_push($filterd_products, $products);
            }

            if($filterd_products !== []){
                return view('shop', [
                    "products" => $filterd_products,
                ]);
            }
        }


        // if(isset($_POST['babylist-id']) || isset($_SESSION['babylist-id'])){

        //     if(isset($_POST['babylist-id'])){
        //         // Add values to the session.
        //         $babylist_id = $_POST['babylist-id'];
        //         $_SESSION['babylist-id'] = $babylist_id;
        //     }

        // }

        // dd(Product::all());
        return view('shop', [
            "products" => Product::all(),
        ]);


    }

    // public function store($category) {
    //     dd('post will happen here');
    // }
}
