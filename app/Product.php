<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($product){
            $product->slug = Str::slug($product->name);
        });
    }


    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}
