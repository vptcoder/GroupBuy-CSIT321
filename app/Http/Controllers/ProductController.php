<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * FOR TESTING
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::leftJoin('groupbuys', function ($q) {
            $q->on('groupbuys.product_id', '=', 'products.id')
                ->where('groupbuys.status', '<>', 'g01');
        })
            ->leftJoin('orders', function ($q) {
                $q->on('orders.groupbuy_id', '=', 'groupbuys.id');
            })
            ->groupBy('groupbuys.id')
            // ->sum('orders.quantity')
            // ->select(
            //     'products.id'
            //     , 'products.status as product_status'
            //     , 'products.description as product_description'
            //     , 'products.name as product_name'
            //     , 'products.image as product_image'
            //     , 'products.min as product_min'
            //     , 'products.max as product_max'
            //     , 'products.price as product_price'
            //     , 'groupbuys.id as groupbuy_id'
            //     , 'groupbuys.status as groupbuy_status'
            //     , 'groupbuys.date_end as groupbuy_date_end'
            //     , 'groupbuys.min_required as groupbuy_min'
            //     , 'groupbuys.max_available as groupbuy_max'
            //     , 'groupbuys.date_success as groupbuy_date_success'
            //     , 'sum(orders.quantity)'
            // )
            ->select()
            ->get();

        return response()->json($products, 200);
    }

    public function userIndex()
    {
        //1. Retrieve data
        $products = Product::select(
            'products.id',
            'products.status as product_status',
            'products.description as product_description',
            'products.name as product_name',
            'products.image as product_image',
            'products.min as product_min',
            'products.max as product_max',
            'products.price as product_price'
        )
            ->with([
                'watchlists:product_id,id,user_id', 'groupbuys' => function ($q) {
                    $q
                        ->where('groupbuys.status', '<>', 'g01')
                        ->select(
                            'groupbuys.id',
                            'groupbuys.product_id',
                            'groupbuys.status',
                            'groupbuys.min_required',
                            'groupbuys.max_available',
                            'groupbuys.date_end'
                        )
                        ->with('orders');
                }
            ])
            ->where('products.status', '=', 'p11')
            ->get();

        //2. Organise data
        foreach ($products as $p) {
            if (!empty($p->groupbuys)) {
                error_log(print_r($p->groupbuys->count(), TRUE));

                if ($p->groupbuys->count() > 1) {
                    throw new \Exception("Error: more than 1 active groupbuy is retrieved!");
                }

                if ($p->groupbuys->count() == 0) {
                    $p->groupbuy_id = null;
                    $p->groupbuy_status = "Pending";
                } else {
                    $p->groupbuy_id = $p->groupbuys[0]->id;
                    $p->groupbuy_min = $p->groupbuys[0]->min_required;
                    $p->groupbuy_max = $p->groupbuys[0]->max_available;
                    $p->groupbuy_date_end = $p->groupbuys[0]->date_end;

                    $sumQuantity = 0;
                    if (!empty($p->groupbuys[0]->orders) && $p->groupbuys[0]->orders->count() > 0) {
                        foreach ($p->groupbuys[0]->orders as $o) {
                            $sumQuantity += $o->quantity;
                        }
                    }
                    $p->groupbuy_orders = $sumQuantity;

                    $status = null;
                    switch ($p->groupbuys[0]->status) {
                        case 'g11':
                            $status = "Active";
                            break;
                        case 'g12':
                            $status = "Processing";
                            break;
                        case 'g13':
                            $status = "Processing";
                            break;
                        case 'g21':
                            $status = "Closed";
                            break;
                    }
                    $p->groupbuy_status = $status;
                }
            }
            unset($p->groupbuys);
        }

        return response()->json($products, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex()
    {
        $products = Product::leftJoin('groupbuys', function ($q) {
            $q->on('groupbuys.product_id', '=', 'products.id')
                ->where('groupbuys.status', '<>', 'g21');
        })
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.description',
                'products.min',
                'products.max',
                'groupbuys.id as groupbuy_id'
            )
            ->withCount([
                'orders', 'watchlists', 'groupbuys as groupbuys_active_count' => function ($q) {
                    $q->where('status', '<>', 'g21');
                }, 'groupbuys as groupbuys_closed_count' => function ($q) {
                    $q->where('status', '=', 'g21');
                }
            ])
            ->get();

        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name, 'min' => $request->min, 'max' => $request->max, 'price' => $request->price, 'description' => $request->description, 'image' => $request->image
        ]);

        return response()->json([
            'status' => (bool) $product, 'data' => $product, 'message' => $product ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    /**
     * Display the specified resource.
     * Used on SingleProdct.vue
     * 
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = Product::where('id', '=', $product->id)
            ->with([
                'watchlists', 'groupbuys' => function ($q) {
                    $q
                        ->where('groupbuys.status', '<>', 'g01')
                        ->select(
                            'groupbuys.id',
                            'groupbuys.product_id',
                            'groupbuys.status',
                            'groupbuys.min_required',
                            'groupbuys.max_available',
                            'groupbuys.date_end'
                        )
                        ->with('orders');
                }
            ])
            ->get()->first();

        if (!empty($product->groupbuys)) {
            if ($product->groupbuys->count() > 1) {
                throw new \Exception("Error: more than 1 active groupbuy is retrieved!");
            }

            if ($product->groupbuys->count() == 0) {
                $product->groupbuy_id = null;
                $product->groupbuy_status = "Pending";
            } else {
                $product->groupbuy_id = $product->groupbuys[0]->id;
                $product->groupbuy_min = $product->groupbuys[0]->min_required;
                $product->groupbuy_max = $product->groupbuys[0]->max_available;
                $product->groupbuy_date_end = $product->groupbuys[0]->date_end;

                $sumQuantity = 0;
                if (!empty($product->groupbuys[0]->orders) && $product->groupbuys[0]->orders->count() > 0) {
                    foreach ($product->groupbuys[0]->orders as $o) {
                        $sumQuantity += $o->quantity;
                    }
                }
                $product->groupbuy_orders = $sumQuantity;

                $status = null;
                switch ($product->groupbuys[0]->status) {
                    case 'g11':
                        $status = "Active";
                        break;
                    case 'g12':
                        $status = "Processing";
                        break;
                    case 'g13':
                        $status = "Processing";
                        break;
                    case 'g21':
                        $status = "Closed";
                        break;
                }
                $product->groupbuy_status = $status;
            }
        }
        unset($product->groupbuys);

        return response()->json($product, 200);
    }

    public function uploadFile(Request $request)
    {
        if ($request->hasFile('image')) {
            $name = time() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $name);
        }
        return response()->json(asset("images/$name"), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $status = $product->update(
            $request->only(['name', 'description', 'price', 'image', 'min', 'max'])
        );

        return response()->json([
            'status' => $status, 'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    public function updateMinMax(Request $request, Product $product)
    {
        $product->min = $request->get('min');
        $product->max = $request->get('max');
        $status = $product->save();

        return response()->json([
            'status' => $status, 'message' => $status ? 'Min and Max Changed!' : 'Error Changing Product\'s Min and Max'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $status = $product->delete();

        return response()->json([
            'status' => $status, 'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
