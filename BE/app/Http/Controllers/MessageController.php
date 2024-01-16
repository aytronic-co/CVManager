<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;


use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();
        if ($messages->count() == 0){
            return response()->json(['status'=>false,'message'=> 'there is not any submitted message']);
        }
        else{
            return response()->json(['status'=>true, 'messages'=>$messages]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'full_name'=>'required|string',
            'text'=>'required|string',
        ]);
        if ($validator->fails()){
            return response()->json(['status'=>false,'message'=> $validator->messages()]);
        }
        $message = Message::create([
             'full_name'=>$request->full_name,
             'contact_number'=>$request->contact_number,
             'email'=>$request->email,
             'text'=>$request->text,
             'status'=>false,
        ]);
        if (!$message){
            return response()->json(['status'=>false,'message'=> 'message dosnt save']);
        }
        else
            return response()->json(['status'=>true, 'education'=> $message]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return $message;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        $message -> update([
             'answerText'=>$request->answerText,
             'status'=>$request->status,
        ]);
        if (!$message){
            return response()->json(['status'=>false,'message'=> 'message dosnt save']);
        }
        else
            return response()->json(['status'=>true, 'message'=> $message]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        if ($message->delete()){
            return response()->json(['status'=>true, 'message'=> 'message deleted successfully']);
        }
        else{
            return response()->json(['status'=>false, 'message'=> 'message doesnt delete']);
        }
    }
}
