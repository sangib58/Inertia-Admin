<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model
{
    protected $table='menugroup';
    protected $primaryKey = 'menuGroupId';
    const CREATED_AT = 'dateAdded';
    const UPDATED_AT = 'lastUpdatedDate';

    protected $guarded = [];
}
