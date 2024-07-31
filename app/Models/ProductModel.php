<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'quantity',
    ];
    public $timestamps = false;
    public function properties()
    {
        return $this->belongsToMany(PropertyModel::class, 'product_property', 'product_id', 'property_id')
        ->withPivot('value');
    }
}
