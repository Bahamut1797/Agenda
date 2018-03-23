<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    //
    protected $fillable = ['userId', 'title', 'category', 'isPayment', 'amount', 'location', 'urlLoc', 'frecuency', 'repeat', 'alarmDate', 'alarmTime', 'deleteIt'];
}
