<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user= $request->user();
        $profile = $user->profile;
        if (!$profile){
            return response()->json(['status'=>false,'message'=> 'profile not found']);
        }
        else{
            return response()->json(['status'=>true, $profile]);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'full_name'=>'required|string',
            
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        
        return $profile;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
