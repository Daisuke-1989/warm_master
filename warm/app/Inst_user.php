<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inst_user extends Model
{
    //
    protected $fillable = [
        'id',
        'inst_id',
        'j_title',
        'dept'
    ];
}
