<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogHistory extends Model
{
    protected $table='loghistory';
    protected $primaryKey = 'logId';
    public $timestamps = false;

    protected $guarded = [];
}
