<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyEvent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'event_id'
    ];
}
