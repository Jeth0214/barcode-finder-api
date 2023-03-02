<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    function login(Request $request) {
        $user = User::where( 'name', $request->name)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'status' => 'danger',
                'message' => 'These credentials do not match our records.',
                    'user' => []
            ], 404);
        };
        $token = $user->createToken('barcode_finder-token')->plainTextToken;
        $user->token = $token;
        $user->save();

        $response = [
            'status' => 'success',
            'message' => 'Welcome ' . $user->name ,
            'user' => $user,
        ];

        return response($response, 201);
    }
}
