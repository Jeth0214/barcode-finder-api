<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Api\BaseController as BaseController;

class UsersController extends BaseController

{


    
   public function login(Request $request) {
        $user = User::where( 'name', $request->name)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendResponse('Error', 'These credentials do not match our records.', 404 );
        };
        $token = $user->createToken('barcode_finder-token')->plainTextToken;
        $user->save();

        $data = [
            'token' => $token,
            'user' => $user,
        ];

      return  $this->sendResponse('Success', 'Welcome ' . $user->name, 200, $data );
    }

     public function logout(Request $request) {

        auth('sanctum')->user()->currentAccessToken()->delete();
        Auth::guard('web')->logout();
        return  $this->sendResponse('Success', 'Logout Successfuly', 200 );
    }
}
