<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table='sitesettings';
    protected $primaryKey = 'siteSettingsId';
    const CREATED_AT = 'dateAdded';
    const UPDATED_AT = 'lastUpdatedDate';

    protected $guarded = [];
}
