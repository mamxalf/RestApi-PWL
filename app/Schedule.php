<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = [
        'fotografer_id', 'classroom_id', 'location', 'date', 'time', 'status',
    ];

    protected $primaryKey = 'schedule_id';
}
