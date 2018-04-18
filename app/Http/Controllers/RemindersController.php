<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class RemindersController extends Controller
{
    public function index()
    {
        //
        return view('admin.reminders.index');
    }

}
