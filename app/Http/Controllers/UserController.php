<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['orders'])->get();
        foreach ($users as $u){
            $u->joined = $u->created_at->format('Y-m-d h:m:s');
        }
        return response()->json($users);
    }

    public function login(Request $request)
    {
        $status = 401;
        $response = ['error' => 'Unauthorised'];

        if (Auth::attempt($request->only(['email', 'password']))) {
            $status = 200;
            $response = [
                'user' => Auth::user(), 'token' => Auth::user()->createToken('bigStore')->accessToken
            ];
        }

        return response()->json($response, $status);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' =>'required|max:50'
            , 'name' => 'required|max:100'
            , 'email' => 'required|email'
            , 'shipping_streetaddress' => 'required|max:200'
            , 'shipping_city' => 'required|max:50'
            , 'shipping_postalcode' => 'required|min:6|max:15'
            , 'password' => 'required|min:6'
            , 'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = $request->only([
            'username'
            , 'name'
            , 'email'
            , 'shipping_streetaddress'
            , 'shipping_city'
            , 'shipping_postalcode'
            , 'password'
        ]);
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $user->is_admin = 0;

        return response()->json([
            'user' => $user, 'token' => $user->createToken('bigStore')->accessToken
        ]);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function showOrders(User $user)
    {
        return response()->json($user->orders()->with(['product'])->get());
    }

    public function showWatchlists(User $user)
    {
        return response()->json($user->watchlists()->with(['product'])->ge());
    }
}
