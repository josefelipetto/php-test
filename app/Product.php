<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    protected static function boot() : void
    {
        parent::boot();

        self::saving(static function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }


    /**
     * @return BelongsTo
     */
    public function retailer(): BelongsTo
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


    public function path(): string
    {
        return "/products/{$this->slug}";
    }

    public function getRouteKeyName() : string
    {
        return 'slug';
    }
}
