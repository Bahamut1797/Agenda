<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchiveReminder extends Model
{
    //
    protected $fillable = ['title', 'category', 'isPayment', 'amount', 'location', 'frecuency', 'alarmDate', 'alarmTime'];
}
