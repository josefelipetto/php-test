<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     *
     */
    protected static function boot()
    {
        parent::boot();

        self::saving(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }


    /**
     * @param $slug
     * @return mixed
     */
    public function getBySlug($slug)
    {
        return self::where('slug',$slug)->first();
    }


    public function path()
    {
        return "/products/{$this->slug}";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
