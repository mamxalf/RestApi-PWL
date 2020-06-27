<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotografer extends Model
{
    protected $table = 'fotografers';

    protected $fillable = [
        'name', 'username', 'email', 'foto', 'kontak', 'alamat',
    ];

    protected $primaryKey = 'fotografer_id';

    protected $hidden = [
        'password',
    ];
}
