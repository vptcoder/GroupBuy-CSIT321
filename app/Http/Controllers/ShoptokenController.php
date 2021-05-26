<?php

namespace App\Http\Controllers;

use App\Models\Shoptoken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShoptokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('ShoptokenController::index');

        return response()->json(Shoptoken::with(['user'])->get(), 200);
    }

    public function indexAvailable(User $user)
    {
        Log::info('ShoptokenController::index');
        $shoptokens = $user->shoptokens()->whereNull('groupbuy_id')->get();
        Log::info($shoptokens);
        if($shoptokens->isEmpty()){
            $shoptokens = null;
        }
        return response()->json($shoptokens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info('ShoptokenController::create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('ShoptokenController::store');
        Log::info($request);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shoptoken  $shoptoken
     * @return \Illuminate\Http\Response
     */
    public function show(Shoptoken $shoptoken)
    {
        Log::info('ShoptokenController::show');
        Log::info($shoptoken);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shoptoken  $shoptoken
     * @return \Illuminate\Http\Response
     */
    public function edit(Shoptoken $shoptoken)
    {
        Log::info('ShoptokenController::edit');
        Log::info($shoptoken);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shoptoken  $shoptoken
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shoptoken $shoptoken)
    {
        Log::info('ShoptokenController::update');
        Log::info($request);
        Log::info($shoptoken);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shoptoken  $shoptoken
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shoptoken $shoptoken)
    {
        Log::info('ShoptokenController::destroy');
        Log::info($shoptoken);
        //
    }
}
