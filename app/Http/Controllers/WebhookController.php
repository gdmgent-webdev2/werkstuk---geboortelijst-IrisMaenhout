<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class WebhookController extends Controller
{
    public function Handle(Request $request) {
        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);


        if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {
            /*
             * The payment is paid and isn't refunded or charged back.
             * At this point you'd probably want to start the process of delivering the product to the customer.
             */
        } elseif ($payment->isOpen()) {
            /*
             * The payment is open.
             */
        } elseif ($payment->isPending()) {
            /*
             * The payment is pending.
             */
        } elseif ($payment->isFailed()) {
            /*
             * The payment has failed.
             */
        } elseif ($payment->isExpired()) {
            /*
             * The payment is expired.
             */
        } elseif ($payment->isCanceled()) {
            /*
             * The payment has been canceled.
             */
        } elseif ($payment->hasRefunds()) {
            /*
             * The payment has been (partially) refunded.
             * The status of the payment is still "paid"
             */
        } elseif ($payment->hasChargebacks()) {
            /*
             * The payment has been (partially) charged back.
             * The status of the payment is still "paid"
             */
        }
    }
}
