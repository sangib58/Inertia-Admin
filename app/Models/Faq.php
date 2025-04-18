<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table='faqs';
    protected $primaryKey = 'faqId';
    const CREATED_AT = 'dateAdded';
    const UPDATED_AT = 'lastUpdatedDate';

    protected $fillable=['title','description','addedBy'];
}
