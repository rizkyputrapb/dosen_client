<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RPSModel extends Model
{
    protected $table = 'tb_rpsfiles';

    protected $fillable = [
        'mk_Code',
        'file',
    ];
}
