<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    protected $table = 'inputs';

    protected $fillable = [
        'schedule_id', 'name', 'file_name',
    ];

    protected $primaryKey = 'input_id';
}
