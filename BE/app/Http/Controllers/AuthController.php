<?php

namespace App\Http\Controllers;


use App\Library\SendSMS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|min:10'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages()]);
        }
        $user = User::where('mobile', $request->moblie)->first();
        if(!$user){
            return response()->json(['status'=>false , 'message'=>'user does not exist']);
        }
    }
}
