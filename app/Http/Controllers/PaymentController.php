<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Watchlist;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe;
use Session;
use Laravel\Cashier\Cashier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
	public function index()
	{
        Log::info('PaymentController::index');

		$payments = Payment::join('users', 'users.id', '=', 'payments.user_id')
			->select(
				'payments.*',
				'users.username as user_name'
			)
			->orderBy('payments.id', 'desc')
			->get();
		foreach ($payments as $p) {
			$p->statustext = null;
			switch ($p->status) {
				case 'p11':
					$status = "Pending payment";
					break;
				case 'p12':
					$status = "Paid";
					break;
				case 'p21':
					$status = "Cancelled";
					break;
			}
			$p->statustext = $status;
		}

		return response()->json($payments, 200);
		// return view('welcome');
	}

	public static function createPayment(Order $order)
	{
        Log::info('PaymentController::createPayment');
        Log::info($order);

		date_default_timezone_set('Asia/Singapore');
		$time_plus_3 = Carbon::now();
		$time_plus_3->modify('+' . Config::get('app.PERIOD_JOIN') . ' day');

		$p = $order->payment()->create([
			'order_id' => $order->id, 'user_id' => $order->user_id, 'status' => 'p11', 'amount' => $order->confirmedPrice, 'date_due' => $time_plus_3
		]);

		return $p;
	}

	public function makePayment(Request $request)
	{
        Log::info('PaymentController::makePayment');
        Log::info($request);

		Stripe\Stripe::setApiKey(Config::get('app.STRIPE_SECRET'));
		Stripe\Charge::create([
			"amount" => 120 * 100,
			"currency" => "inr",
			"source" => $request->stripeToken,
			"description" => "Make payment and chill."
		]);

		Session::flash('success', 'Payment successfully made.');

		return back();
	}

	public function makeStripePayment(Request $request)
	{
        Log::info('PaymentController::makeStripePayment');
        Log::info($request);

		date_default_timezone_set('Asia/Singapore');

		$user = User::where('id', '=', $request->user["id"])->first();

		$stripeCharge = $user->charge(
			($request->amount * 100),
			$request->payment_method_id
		);
		if ($stripeCharge) {

			$stripeCharge = $stripeCharge->asStripePaymentIntent();

			$order = Order::where('id', '=', $request->order["id"])->first();
			$payment = $order->payment()->first();
			$payment->status = 'p12';
			$payment->transaction_id = $stripeCharge->charges->data[0]->id;
			$payment->method = $request->payment_method_id;
			$payment->date_paid = Carbon::now();
			$payment->save();

			OrderController::updateToNextStatus($order);


			Session::flash('success', 'Payment successfully made.');
			return back();
		}
		// return $payment;
	}
}
