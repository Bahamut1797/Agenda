<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchiveReminder extends Model
{
    //
    protected $fillable = ['userId', 'title', 'category', 'isPayment', 'amount', 'location', 'frecuency', 'alarmDate', 'alarmTime'];
}
