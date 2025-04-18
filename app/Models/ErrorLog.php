<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $table='errorlogs';
    protected $primaryKey = 'errorLogId';
    public $timestamps = false;

    protected $guarded = [];
}
