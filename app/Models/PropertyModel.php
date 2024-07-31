<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyModel extends Model
{
    protected $table = 'properties';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;
}
