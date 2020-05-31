<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KontrakModel extends Model
{
    protected $table = 'tb_kontrakkuliah';

    protected $fillable = [
        'mk_Code',
        'file',
        'updated_by',
    ];
}
