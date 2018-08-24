<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         
        $userId = Auth::user()->id;
        $contactId = $request->contact_id;
        $messages = Message::select(
            'id',
            'content',
            'created_at',
            DB::raw("IF(from_id=$userId,true,false) as written_by_me")
        )->where(function($query) use($userId,$contactId){
            $query->where('from_id',$userId)->where('to_id',$contactId);
        })->orWhere(function($query) use($userId,$contactId){
            $query->where('from_id',$contactId)->where('to_id',$userId);
        })->get();
        return response()->json($messages);
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
        $request['from_id'] = Auth::user()->id;
        $message = Message::create($request->all());
        if($message){
            return response()->json($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
