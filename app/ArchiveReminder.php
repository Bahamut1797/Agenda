<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchiveReminder extends Model
{
    //
    protected $fillable = ['userId', 'title', 'category', 'isPayment', 'amount', 'location', 'urlLoc', 'frecuency', 'alarmDate', 'alarmTime'];
}
