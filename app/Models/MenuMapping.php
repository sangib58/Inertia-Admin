<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuMapping extends Model
{
    protected $table='menugroupwisemenumapping';
    protected $primaryKey = 'menuGroupWiseMenuMappingId';
    public $timestamps = false;

    protected $guarded=[];
}
