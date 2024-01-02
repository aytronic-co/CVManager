<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            'contact_number'=>'required|min:10',
        ]);
        if ($validator->fails()){
            return response()->json(['status'=>false,'message'=> $validator->messages()]);
        }        
        $profile= new Profile();
        $profile->user_id=$request->user()->id;
        $profile->full_name=$request->full_name;
        $profile->contact_number=$request->contact_number;
        $profile->birth_date=$request->birth_date;
        $profile->birth_country=$request->birth_country;
        $profile->contact_email=$request->contact_email;
        $profile->social_links=$request->social_links;
        $profile->address=$request->address;
        $profile->about=$request->about;
        $profile->marrid=$request->marrid;
        $profile->gender=$request->gender;
        $profile->khedmat=$request->khedmat;
        if ($request->status)
             $profile->status=$request->status;
        $profile->save();
        if ($request->image_url){
            $path=$request->file('image_url')->storeAs('avatars', Carbon::now()->microsecond . '.jpg','public' );
            $profile->image()->create(['url'=> $path]);
        }
        return response()->json(['status'=>true, $profile]);

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
        $validator = Validator::make($request->all(),[
            'full_name'=>'required|string',
            'contact_number'=>'required|min:10',
        ]);
        if ($validator->fails()){
            return response()->json(['status'=>false,'message'=> $validator->messages()]);
        }
        $profile->full_name=$request->full_name;
        $profile->contact_number=$request->contact_number;
        if ($request->birth_date)
            $profile->birth_date=$request->birth_date;
        if ($request->birth_country)
            $profile->birth_country=$request->birth_country;
        if ($request->contact_email)
            $profile->contact_email=$request->contact_email;
        if ($request->social_links)
            $profile->social_links=$request->social_links;
        if ($request->address)
            $profile->address=$request->address;
        if ($request->about)
            $profile->about=$request->about;
        if ($request->status)
            $profile->marrid=$request->marrid;
        if ($request->gender)
            $profile->gender=$request->gender;
        if ($request->khedmat)
            $profile->khedmat=$request->khedmat;
        if ($request->status)
            $profile->status=$request->status;
        $profile->save();
        if ($request->image_url){
            $path=$request->file('image_url')->storeAs('avatars', Carbon::now()->microsecond . '.jpg','public' );
            $profile->image()->update(['url'=> $path]);
        }
        return response()->json(['status'=>true, $profile]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //$profile->delete();
        return response()->json(['status'=>false,'message'=> 'you cant delete your profile']);
    }
}
