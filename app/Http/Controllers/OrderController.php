<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Auth;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['product'])->get();
        foreach ($orders as $o) {
            $o->statustext = null;
            switch ($o->status) {
                case 'o11':
                    $status = "Order pending";
                    break;
                case 'o12':
                    $status = "Pending payment";
                    break;
                case 'o13':
                    $status = "Paid";
                    break;
                case 'o14':
                    $status = "Shipping";
                    break;
                case 'o15':
                    $status = "Order complete";
                    break;
                case 'o21':
                    $status = "Cancelled";
                    break;
                case 'o22':
                    $status = "Refunded";
                    break;
            }
            $o->statustext = $status;
        }
        return response()->json($orders, 200);
    }

    public function indexForPayment(Request $request)
    {
        error_log(print_r("OrderController::indexForPayment", TRUE));

        $orders = Order::join('products', 'products.id', '=', 'orders.product_id')
            ->join('payments', 'payments.id', '=', 'orders.payment_id')
            ->select(
                'orders.*',
                'products.name as product_name',
                'products.image as product_image',
                'payments.date_due'
            )
            ->where('orders.user_id', '=', $request->userid)
            ->where('orders.status', '=', 'o12')
            ->get();

        foreach ($orders as $o) {
            $o->selection = ($o->quantity) . " of " . ($o->product_name);
        }

        return response()->json($orders);
    }

    public function indexForProcessing(Request $request)
    {
        error_log(print_r("OrderController::indexForProcessing", TRUE));

        $orders = Order::join('products', 'products.id', '=', 'orders.product_id')
            ->join('payments', 'payments.id', '=', 'orders.payment_id')
            ->select(
                'orders.*',
                'products.name as product_name',
                'products.image as product_image',
                'payments.date_paid'
            )
            ->where('orders.user_id', '=', $request->userid)
            ->where('orders.status', '=', 'o13')
            ->get();

        foreach ($orders as $o) {
            $o->selection = ($o->quantity) . " of " . ($o->product_name);
        }

        return response()->json($orders);
    }

    public function indexForShipping(Request $request)
    {
        error_log(print_r("OrderController::indexForProcessing", TRUE));

        $orders = Order::join('products', 'products.id', '=', 'orders.product_id')
            ->join('payments', 'payments.id', '=', 'orders.payment_id')
            ->select(
                'orders.*',
                'products.name as product_name',
                'products.image as product_image',
                'payments.date_paid'
            )
            ->where('orders.user_id', '=', $request->userid)
            ->where('orders.status', '=', 'o14')
            ->get();

        foreach ($orders as $o) {
            $o->selection = ($o->quantity) . " of " . ($o->product_name);
        }

        return response()->json($orders);
    }

    public function deliverOrder(Order $order)
    {
        error_log(print_r("OrderController::deliverOrder", TRUE));

        $order->is_delivered = true;
        $status = $order->save();

        return response()->json([
            'status'    => $status,
            'data'      => $order,
            'message'   => $status ? 'Order Delivered!' : 'Error Delivering Order'
        ]);
    }

    public function shipOrder(Request $request)
    {
        error_log(print_r("OrderController::shipOrder", TRUE));
        $order = Order::where('id', $request->orderid)->first();
        $order->status = 'o14';
        $status = $order->save();

        return response()->json([
            'status'    => $status,
            'data'      => $order,
            'message'   => $status ? 'Order Shipping!' : 'Error Shipping Order'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'address' => $request->address
        ]);

        return response()->json([
            'status' => (bool) $order,
            'data'   => $order,
            'message' => $order ? 'Order Created!' : 'Error Creating Order'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json($order, 200);
    }

    public static function updateToNextStatus($order)
    {
        error_log(print_r("OrderController::updateToNextStatus", TRUE));
        $status = $order->status;

        $status = (int)(ltrim($status, 'o'));

        if ($status < 15) {
            $status++;
        } elseif ($status == 15) {
            throw new Exception("Max 1x status");
        } elseif ($status == 21) {
            $status++;
        } elseif ($status == 22) {
            throw new Exception("Max 2x status");
        } else {
            throw new Exception("Status not recognised!");
        }

        $order->status = 'o' . $status;

        $title = null;
        $message = null;
        $link = null;

        if ($status == 12) {
            $payment = PaymentController::createPayment($order);
            $order->payment_id = $payment->id;

            $p = $order->product()->first();
            $title = "Groupbuy successful!";
            $message = "Groupbuy '" . ($p->name) . "' is successful! You can go make payment now.";
            $link = "/payment";
        } else if ($status == 13) {
            $p = $order->product()->first();
            $title = "Payment completed!";
            $message = "Payment for '" . ($p->name) . "' has been made!.";
        }

        $order->save();

        if ($title && $message) {
            NotificationController::storeForUser(
                $order->user_id,
                $title,
                $message,
                $link
            );
        }
    }

    public function update(Request $request, Order $order)
    {
        $status = $order->update(
            $request->only(['quantity'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Order Updated!' : 'Error Updating Order'
        ]);
    }

    public function destroy(Order $order)
    {
        $status = $order->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Order Deleted!' : 'Error Deleting Order'
        ]);
    }
}
