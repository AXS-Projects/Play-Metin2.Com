<?php

namespace App\Http\Controllers;

use App\Models\Metin2User;
use App\Models\Payment;
use App\Models\PaymentPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index()
    {
        $packages = PaymentPackage::all();

        return view('payments.index', compact('packages'));
    }

    public function checkout(Request $request, PaymentPackage $package)
    {
        $user = Auth::guard('metin2')->user();

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => $package->currency,
                    'product_data' => ['name' => $package->name],
                    'unit_amount' => (int) ($package->price * 100),
                ],
                'quantity' => 1,
            ]],
            'customer_email' => $user->email,
            'metadata' => [
                'user_id' => $user->id,
                'package_id' => $package->id,
            ],
            'success_url' => route('coins.success', [], true).'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('coins.cancel', [], true),
        ]);

        $payment = Payment::create([
            'metin2_user_id' => $user->id,
            'payment_package_id' => $package->id,
            'stripe_session_id' => $session->id,
            'amount' => $package->price,
            'coins' => $package->coins,
            'ip_address' => $request->ip(),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        if (! $sessionId) {
            return redirect()->route('coins.index');
        }

        Stripe::setApiKey(config('services.stripe.secret'));
        $session = Session::retrieve($sessionId);

        if ($session->payment_status === 'paid') {
            $payment = Payment::where('stripe_session_id', $sessionId)->first();
            if ($payment && $payment->status !== 'paid') {
                $payment->status = 'paid';
                $payment->save();

                $user = Metin2User::find($payment->metin2_user_id);
                if ($user) {
                    $user->coins += $payment->coins;
                    $user->save();
                }
            }
        }

        return redirect()->route('coins.index')->with('success', 'Payment successful!');
    }

    public function cancel()
    {
        return redirect()->route('coins.index')->with('error', 'Payment cancelled.');
    }
}
