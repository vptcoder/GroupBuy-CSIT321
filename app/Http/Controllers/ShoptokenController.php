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
        if ($shoptokens->isEmpty()) {
            $shoptokens = null;
        }
        return response()->json($shoptokens);
    }

    public function useToken(Request $request)
    {
        Log::info('ShoptokenController::store');
        Log::info($request);
        $availCount = Shoptoken::where('user_id', '=', $request->userid)->whereNull('groupbuy_id')->get()->count();
        Log::info($availCount);
        if ($availCount > 0) {
            $token = Shoptoken::where('user_id', '=', $request->userid)->whereNull('groupbuy_id')->first();
            $token->groupbuy_id = $request->groupbuyid;
            $token->save();


            return response()->json([
                'status' => (bool) $token, 'data' => $token,
                'message' => $token ? 'Token used!' : 'Error using token'
            ]);
        } else {
            $status = false;
            return response()->json([
                'status' => $status, 'message' => 'No token available'
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public static function rewardToken($userid)
    {
        Log::info('ShoptokenController::rewardToken');

        $token = Shoptoken::create([
            'user_id' => $userid
        ]);

        $title = "Token reward!";
        $message = "Thank you for shopping with us! You have been gifted a Reward Token as a 'token' of appreciation from us!";

        if ($title && $message) {
            NotificationController::storeForUser(
                $userid,
                $title,
                $message,
            );
        }
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
