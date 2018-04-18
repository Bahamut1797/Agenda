<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchiveReminder extends Model
{
    //
    protected $fillable = ['userId', 'email', 'title', 'category', 'description', 'isPayment', 'amount', 'location', 'urlLoc', 'contact', 'frecuency', 'custom', 'alarmDate', 'alarmTime', 'secEmail'];
}
