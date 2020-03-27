<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    protected static function boot() : void
    {
        parent::boot();

        self::saving(static function ($retailer) {
           $retailer->slug = Str::slug($retailer->name);
        });
    }


    /**
     * @return HasMany
     */
    public function products(): HasMany
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


    public function path(): string
    {
        return "/retailers/{$this->slug}";
    }


    public function getRouteKeyName() : string
    {
        return 'slug';
    }
}
