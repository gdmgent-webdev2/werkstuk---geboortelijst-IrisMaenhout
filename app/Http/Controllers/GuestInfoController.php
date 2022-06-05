<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class GuestInfoController extends Controller
{
    public function show()
    {

        if(isset($_POST['message'])){
            session_start();
            // Add message to the session.
            $message = $_POST['message'];
            $_SESSION['message'] = $message;
        };

        return View('guest_info');
    }

    public function Save()
    {
        // save order
        session_start();
        $message = $_SESSION['message'];
        $cart_items = Cart::session(1)->getContent();

        foreach($cart_items as $item){
            $saved_products = new Order;
            $saved_products->babylist_id = $item['attributes']['babylist_id'];
            $saved_products->product_id = $item['id'];
            $saved_products->first_name = $_POST['guest-first-name'];
            $saved_products->last_name = $_POST['guest-last-name'];
            $saved_products->email = $_POST['guest-email'];
            $saved_products->message = $message;
            $saved_products->status = 'in shoppingcart';
            $saved_products->save();
        };

        return redirect('/checkout');
    }
}
