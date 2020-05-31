<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SAPModel extends Model
{
    protected $table = 'tb_sapfiles';

    protected $fillable = [
        'mk_Code',
        'file',
    ];
}
