<?php

namespace App\Http\Controllers\Api\V1;

use App\ArchiveReminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ArchiveRemindersController extends Controller
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
        return ArchiveReminder::where('userId', $userID)
                            ->orderBy('alarmDate', 'DESC')
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
        $archiveReminder = ArchiveReminder::create($request->all());
        return $archiveReminder;
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
        return ArchiveReminder::where('userId', $userID)->findOrFail($id);
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
        $archiveReminder = ArchiveReminder::where('userId', $userID)->findOrFail($id);
        $archiveReminder->delete();
        return '';
    }
}
