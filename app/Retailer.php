<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Retailer
 * @package App
 */
class Retailer extends Model
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

        self::saving(function ($retailer) {
           $retailer->slug = Str::slug($retailer->name);
        });
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }


    /**
     * @param $slug
     * @return mixed
     */
    public static function getBySlug($slug)
    {
        return self::where('slug',$slug)->first();
    }


    public function path()
    {
        return "/retailers/{$this->slug}";
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }
}
