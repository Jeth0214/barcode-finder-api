<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    //
   public function login(Request $request) {
        $user = User::where( 'name', $request->name)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'status' => 'danger',
                'message' => 'These credentials do not match our records.',
                    'user' => []
            ], 404);
        };
        $token = $user->createToken('barcode_finder-token')->plainTextToken;
        $user->save();

        $response = [
            'status' => 'success',
            'message' => 'Welcome ' . $user->name ,
            'token' => $token,
            'user' => $user,
        ];

        return response($response, 201);
    }

     public function logout() {
        Session::flush();
        Auth::logout();
        return response(['status' => 'Success'], 200);
    }
}
