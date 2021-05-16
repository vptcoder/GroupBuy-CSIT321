<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public static function storeForUser(int $userid, string $title, string $message, string $link = null)
    {
        error_log(print_r("NotificationController::storeForUser", TRUE));

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
        error_log(print_r("NotificationController::read", TRUE));
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
        //
    }
}
