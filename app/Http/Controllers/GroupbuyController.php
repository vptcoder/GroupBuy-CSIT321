<?php

namespace App\Http\Controllers;

use App\Models\Groupbuy;
use App\Models\Product;
use App\Models\Order;
use Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Monolog\Handler\FirePHPHandler;
use PHPUnit\TextUI\XmlConfiguration\Group;

class GroupbuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userIndex()
    {
        $g = Groupbuy::where('status', '=', 'g01')
            ->get();

        return response()->json($g, 200);
    }

    public function adminIndex()
    {
        $groupbuys =
            Groupbuy::join('products', 'products.id', 'groupbuys.product_id')
            ->select(
                'groupbuys.id',
                'products.name as product_name',
                'groupbuys.status',
                'groupbuys.date_start',
                'groupbuys.date_end',
                'groupbuys.min_required',
                'groupbuys.max_available',
                'groupbuys.started_by',
                'groupbuys.date_success'
            )
            ->get();

        foreach ($groupbuys as $g) {
            $g->orders_count = $g->orders()->get()->sum('quantity');
            $status = null;
            switch ($g->status) {
                case 'g11':
                    $status = "Active";
                    break;
                case 'g12':
                    $status = "Pending payments";
                    break;
                case 'g13':
                    $status = "Processing orders";
                    break;
                case 'g21':
                    $status = "Closed";
                    break;
            }
            $g->status = $status;

            $g->nextStepAdmin = false;
            if (new DateTime($g->date_end) < (new DateTime) && empty($g->date_success)) {
                $g->nextStepAdmin = true;
            }
        }

        return response()->json($groupbuys, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        error_log(print_r($request->groupbuyid, TRUE));

        $currentTime = new DateTime;

        //Create the Groupbuy if not yet exist
        $g = null;
        $orders_count = 0;

        $p = Product::where('id', '=', $request->productid)->get()->first();

        if (empty($request->groupbuyid)) {
            error_log(print_r("checkpoint 1", TRUE));

            //check if there's enough stock for this Groupbuy
            if ($orders_count + $request->quantity > $p->max) {
                return response()->json([
                    'status' => false,
                    'data'   => null,
                    'message' => 'Unable to place order due to stock unavailability!'
                ]);
            }

            $g = Groupbuy::where('status', '=', "g11")->where('product_id', '=', $request->product_id)->first();
            if ($g === null) {
                $dateEnd = clone ($currentTime);
                $dateEnd->modify('+7 day');

                $g = new Groupbuy;
                $g->product_id = $request->productid;
                $g->status = "g11";
                $g->date_start = $currentTime;
                $g->date_end = $dateEnd;
                $g->min_required = $p->min;
                $g->max_available = $p->max;
                $g->started_by = $request->userid;
                $g->date_success = null;
                $g->save();
            }
        } else {
            $g = Groupbuy::where('id', $request->groupbuyid)->get()->first();
        }
        error_log(print_r("checkpoint 2", TRUE));

        //Get the current orders for this Groupbuy
        $orders_count = $g->orders()->get()->sum('quantity');

        //check if there's enough stock for this new Order
        if ($orders_count + $request->quantity > $g->max_available) {
            return response()->json([
                'status' => false,
                'data'   => null,
                'message' => 'Unable to place order due to stock unavailability!'
            ]);
        }

        error_log(print_r(gettype($g->date_end), TRUE));
        $dd = gettype($g->date_end) == 'object' ? $g->date_end : new DateTime($g->date_end);

        //Check if the Order is within valid time
        if ($currentTime >= $dd) {
            error_log(print_r($currentTime, TRUE));
            error_log(print_r($dd, TRUE));
            return response()->json([
                'status' => false,
                'data'   => null,
                'message' => 'Unable to place order as the order time window has closed!'
            ]);
        }

        //Create the Order
        if ($orders_count + $request->quantity <= $g->max_available) {
            $order = Order::create([
                'groupbuy_id' => $g->id, 'product_id' => $request->productid, 'user_id' => $request->userid, 'status' => 'o11', 'quantity' => $request->quantity, 'confirmedPrice' => $request->confirmedPrice, 'shipping_streetaddress' => $request->shipping_streetaddress, 'shipping_city' => $request->shipping_city, 'shipping_postalcode' => $request->shipping_postalcode, 'is_delivered' => false
            ]);

            //Update Groupbuy's status according to amount already ordered
            $orders_count = $g->orders()->get()->sum('quantity');

            if ($orders_count == $g->max_available) {
                error_log(print_r($orders_count, TRUE));
                error_log(print_r($g->max_available, TRUE));
                $g->status = "g12";
                $g->date_success = $currentTime;
                $g->save();
            }

            return response()->json([
                'status' => (bool) $order,
                'data'   => [$order, $orders_count, $g->orders()->get()->sum('quantity')],
                'message' => $order ? 'Order Created!' : 'Error placing order'
            ]);
        }
    }
}
