<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table='userrole';
    protected $primaryKey = 'userRoleId';
    const CREATED_AT = 'dateAdded';
    const UPDATED_AT = 'lastUpdatedDate';

    protected $fillable=['roleName','roleDesc','menuGroupId','addedBy'];
}
