<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WatchlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::info('WatchlistController::index');
        Log::info($request);

        // return response()->json(Watchlist::with(['user'])->get(),200);
        // return response()->json(Watchlist::whereHas('user', function($query) use($request){
        //     $query->where('id', '=', $request->userid);
        // })->get(),200);
        // error_log(print_r($request, TRUE));

        $watchlist = Watchlist::where('user_id', $request->userid)
            ->join('products', 'products.id', '=', 'watchlists.product_id')->get();
        return response()->json($watchlist,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info('WatchlistController::create');
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
        Log::info('WatchlistController::store');
        Log::info($request);

        $oldExist = Watchlist::onlyTrashed()->where('product_id', $request->productid)
            ->where('user_id', $request->userid)->first();

        error_log(print_r($oldExist, TRUE));

        if(!is_null($oldExist) && !is_null($oldExist->id)){
            $oldExist->restore();

            return response()->json([
                'status' => (bool) $oldExist
                , 'data' => $oldExist
                , 'message' => $oldExist ? 'User added to Watchlist!' : 'Error adding user to Watchlist'
            ]);
        }
        else {
            $watchlist = Watchlist::create([
                'product_id' => $request->productid
                , 'user_id' => $request->userid
            ]);    

            return response()->json([
                'status' => (bool) $watchlist
                , 'data' => $watchlist
                , 'message' => $watchlist ? 'User added to Watchlist!' : 'Error adding user to Watchlist'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function show(Watchlist $watchlist)
    {
        Log::info('WatchlistController::show');
        Log::info($watchlist);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Watchlist $watchlist)
    {
        Log::info('WatchlistController::edit');
        Log::info($watchlist);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Watchlist $watchlist)
    {
        Log::info('WatchlistController::update');
        Log::info($request);
        Log::info($watchlist);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Watchlist $watchlist)
    {
        Log::info('WatchlistController::destroy');
        Log::info($watchlist);

        $status = $watchlist->delete();

        return response()->json([
            'status' => $status
            , 'message' => $status ? 'User removed from Watchlist!' : 'Error removing User from Watchlist'
        ]);
    }
}
