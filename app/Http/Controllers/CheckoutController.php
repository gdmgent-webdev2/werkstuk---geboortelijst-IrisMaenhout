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
        $cart_items = Cart::session(1)->getContent();

        foreach($cart_items as $item){
            $order = Order::where('babylist_id', '=', $item['attributes']['babylist_id'])->where('product_id', '=', $item['id'])->get()->first();
            $saved_products = Favorite_Product::where('babylist_id', '=', $item['attributes']['babylist_id'])->where('product_id', '=', $item['id'])->get()->first();

            $order->status = 'paid';
            $order->save();

            $saved_products->status = 'paid';
            $saved_products->save();

            Cart::session(1)->remove($item['id']);
        }

        return view('succes-payment');
    }
}

// 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
