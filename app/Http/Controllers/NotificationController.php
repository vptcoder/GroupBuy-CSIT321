<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('NotificationController::index');
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexUser(Request $request)
    {
        Log::info('NotificationController::indexUser');
        Log::info($request);

        $ns = Notification::where('user_id', $request->userid)->get();
        return response()->json($ns,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info('NotificationController::create');
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
        Log::info('NotificationController::store');
        Log::info($request);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public static function storeForUser(int $userid, string $title, string $message, string $link = null)
    {
        Log::info('NotificationController::index');
        Log::info($userid);
        Log::info($title);
        Log::info($message);
        Log::info($link);

        $n = new Notification;
        $n->user_id = $userid;
        $n->title = $title;
        $n->message = $message;
        $n->link = $link;
        $n->save();

        return $n;
    }

    public function read(Request $request)
    {
        Log::info('NotificationController::read');
        Log::info($request);

        $noti = Notification::where('id','=', $request->id)->first();
        $noti->status = 'n11';
        $status = $noti->save();

        return response()->json([
            'status'    => $status,
            'data'      => $noti,
            'message'   => $status ? 'Notification Read!' : 'Error Reading Notification'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::info('NotificationController::show');
        Log::info($id);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::info('NotificationController::edit');
        Log::info($id);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::info('NotificationController::update');
        Log::info($request);
        Log::info($id);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info('NotificationController::destroy');
        Log::info($id);
        //
    }
}
