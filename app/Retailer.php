<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Retailer extends Model
{

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($retailer) {
           $retailer->slug = Str::slug($retailer->name);
        });
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
