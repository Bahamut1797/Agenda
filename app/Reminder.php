<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    //
    protected $fillable = ['userId', 'title', 'category', 'isPayment', 'amount', 'location', 'urlLoc', 'contact', 'frecuency', 'repeat', 'alarmDate', 'alarmTime', 'secEmail', 'archiveIt', 'isSecret'];
}
