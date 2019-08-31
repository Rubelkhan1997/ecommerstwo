<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Shipping;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $total_amount = $request-> total_amount;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * $total_amount,
                "currency" => "bdt",
                "source" => $request->stripeToken,
                "description" => "Our Ecommerce Websit Customer Payment."
        ]);

        Shipping::find($request->shipping_id)->update([
          'payment_status' => 2,
        ]);
        Session::flash('Cardpayment', 'Payment successful!');

        return redirect('card/page');
    }
}
