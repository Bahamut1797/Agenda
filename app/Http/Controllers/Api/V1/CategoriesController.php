<?php

namespace App\Http\Controllers\Api\V1;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class CategoriesController extends Controller
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
        return Category::where('userId', $userID)
                        ->orderBy('id', 'ASC')
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
        $request->merge(['userId' => $userID]);
        $category = Category::create($request->all());
        return $category;
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
        return Category::where('userId', $userID)->findOrFail($id);
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
        $category = Category::where('userId', $userID)->findOrFail($id);
        $category->update($request->all());
        return $category;
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
        $category = Category::where('userId', $userID)->findOrFail($id);

        $firstCategory = Category::where('userId', $userID)->orderBy('id', 'ASC')->first();
        DB::update("UPDATE `reminders` SET `reminders`.`category` = $firstCategory->id WHERE `reminders`.`userId` = $userID AND `reminders`.`category` = $id");
        
        $category->delete();
        return '';
    }
}
