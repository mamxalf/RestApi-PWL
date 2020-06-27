<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = 'classrooms';

    protected $fillable = [
        'school_id', 'name', 'total_students',
    ];

    protected $primaryKey = 'classroom_id';
}
