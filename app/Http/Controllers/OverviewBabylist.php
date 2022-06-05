<?php

namespace App\Http\Controllers;

use App\Models\Babylist;
use App\Models\Favorite_Product;
use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OverviewBabylist extends Controller
{
    public function Show($name)
    {
        session_start();
        $explode_name = explode( '-', $name);
        $first_name = array_shift($explode_name);

        $babylists = Babylist::where('first_name_child', '=', $first_name)->get()->toArray();

        // Check if babylist exists

        if($babylists == []){
            abort(404);
        };

        $products_list = [];
        $correct_babylist = [];
        $products_shoppingcart = Cart::session(1)->getContent();

        foreach ($babylists as $babylist) {
            if(explode( ' ', strtolower($babylist['last_name_child'])) == $explode_name){

                // GUEST -- check if a password is filled in and if it's the correct one
                if(auth()->user() == null || auth()->user()->id !== $babylist['user_id']){
                    $uri = $_SERVER['REQUEST_URI'];
                    if(isset($_POST['password']) || isset($_SESSION['password'])){

                        if(isset($_POST['password'])){
                            // Add values to the session.
                            $password = $_POST['password'];
                            $_SESSION['password'] = $password;

                            if(!($babylist['password'] === $password)){
                                Session::flash('message', __('Password is incorrect'));
                                return redirect($uri . '/password');
                            }
                        }

                    }else{
                        return redirect($uri . '/password');
                    }
                }


                array_push($correct_babylist, $babylist);

                $favorite_products = Favorite_Product::where('babylist_id', '=', $babylist['id'])->get();
                foreach ($favorite_products as $favorite_product) {
                    $products = Product::where('id', '=', $favorite_product->product_id)->get()->toArray();
                    array_push($products_list, $products);
                }

            }

        }

        return view('overview-babylist', [
            "babylist" => $correct_babylist[0],
            "favorite_products" => $favorite_products,
            "products" => $products_list,
            "products_shoppingcart" => $products_shoppingcart,
        ]);


    }

    public function Delete()
    {
        $product_id = intval($_GET['product-id']);
        $babylist_id = intval($_GET['babylist-id']);

        Favorite_Product::where('product_id', '=', $product_id)->where('babylist_id', '=' , $babylist_id)->first()->delete();

        return back();
    }


    public function Shoppingcart()
    {
        $product_id = intval($_POST['product-id']);
        $babylist_id = intval($_POST['babylist-id']);

        $product = Product::where('id', '=', $product_id)->get();

        $price = floatval(ltrim($product[0]->price, '€'));
        $price_formated = number_format($price, 2);

        // Add product to shoppingcart
        Cart::session(1)->add(array(
            'id' => $product[0]->id,
            'name' => $product[0]->name,
            'price' => $price_formated,
            'quantity' => 1,
            'attributes' => array(
                'image' => $product[0]->image,
                'babylist_id' => $babylist_id,
            ),
            'associatedModel' => $product[0]
        ));

        return redirect()->back();
    }
}
