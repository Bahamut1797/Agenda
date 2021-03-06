<?php

namespace App\Http\Controllers\Api\V1;

use App\Reminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class RemindersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userID = Auth::user()->id;
        return Reminder::where('userId', $userID)
                        ->orderBy('alarmDate', 'ASC')
                        ->orderBy('alarmTime', 'ASC')
                        ->get();
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
        $userID = Auth::user()->id;
        $userEmail = Auth::user()->email;
        $request->merge(['userId' => $userID]);
        $request->merge(['email' => $userEmail]);
        $reminder = Reminder::create($request->all());
        return $reminder;
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
        $userID = Auth::user()->id;
        return Reminder::where('userId', $userID)->findOrFail($id);
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
        $userID = Auth::user()->id;
        $reminder = Reminder::where('userId', $userID)->findOrFail($id);
        $reminder->update($request->all());
        return $reminder;
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
        $userID = Auth::user()->id;
        $reminder = Reminder::where('userId', $userID)->findOrFail($id);
        $reminder->delete();
        return '';
    }
}
