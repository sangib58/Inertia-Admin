<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table='menu';
    protected $primaryKey = 'menuID';
    const CREATED_AT = 'dateAdded';
    const UPDATED_AT = 'lastUpdatedDate';

    protected $guarded=[];
}
