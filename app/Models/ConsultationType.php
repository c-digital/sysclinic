<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationType extends Model
{
    public $timestamps = false;

    protected $table = 'consultations_types';

    protected $fillable = [
        'name',
        'fields',
        'created_by',
    ];
}
