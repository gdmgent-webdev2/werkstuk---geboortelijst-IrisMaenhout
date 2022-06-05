<?php

namespace App\Http\Controllers;

use App\Models\Favorite_Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CheckoutController extends Controller
{
    public function Checkout()
    {
        $total = Cart::session(1)->getTotal();

        $total_formated = number_format($total, 2);

        // dd($total_formated);

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $total_formated // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Order #12345",
            "redirectUrl" => route('order.success'),
            "webhookUrl" => route('webhooks.mollie'),
            "metadata" => [
                "order_id" => "12345",
            ],
        ]);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function Success()
    {
        dump(Cart::session(1)->getContent());
        $order = Order::where('babylist-id', '=', '')->where('product_id', '=', '')->get();
        $saved_products = Favorite_Product::where('babylist-id', '=', '')->where('product_id', '=', '')->get();

        // dump($order);
        // dump()

            // $babylist->first_name_child = $first_name_child;
            // $babylist->last_name_child = $last_name_child;
            // $babylist->password = $password;
            // if ($_FILES['baby_upload']['tmp_name'] !== "") {
            //     $babylist->picture = $path_saved_img;
            // }
            // $babylist->message = $message;
            // $babylist->closed = False;
            // $babylist->save();
            // return redirect()->route('home');


        return 'Jouw bestelling is goed binnengekomen';
    }
}
