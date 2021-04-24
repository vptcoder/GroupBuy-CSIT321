<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('orders', 'watchlists')->get();
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
            'name' => $request->name
            , 'min' => $request->min
            , 'max' => $request->max
            , 'price' => $request->price
            , 'description' => $request->description
            , 'image' => $request->image
        ]);

        return response()->json([
            'status' => (bool) $product
            , 'data' => $product
            , 'message' => $product ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product, 200);
    }

    public function uploadFile(Request $request)
    {
        if($request->hasFile('image'))
        {
            $name = time()."_".$request->file('image')->getClientOriginalName();
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
            'status' => $status
            , 'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    public function updateMinMax(Request $request, Product $product)
    {
        $product->min = $request->get('min');
        $product->max = $request->get('max');
        $status = $product->save();

        return response()->json([
            'status' => $status
            , 'message' => $status ? 'Min and Max Changed!' : 'Error Changing Product\'s Min and Max'
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
            'status' => $status
            , 'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
