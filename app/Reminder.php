<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    //
    protected $fillable = ['title', 'isPayment', 'amount', 'location', 'frecuency', 'repeat', 'alarmDate', 'alarmTime', 'deleteIt'];
}
