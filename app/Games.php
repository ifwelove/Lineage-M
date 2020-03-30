<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Games extends Model
{

    protected $table = 'games';
    public $timestamps = true;
//    use SoftDeletes;

    protected $fillable = [
        'server_id',
        'date',
        'type',
        'grade_cd',
        'row_num',
        'get_time',
        'role_name',
        'item_name',
        'land_nm'
    ];
    protected $dates = ['deleted_at'];
}
