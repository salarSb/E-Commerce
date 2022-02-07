<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'name',
        'introduction',
        'slug ',
        'image',
        'weight',
        'length',
        'width',
        'height',
        'price',
        'status',
        'marketable',
        'tags',
        'sold_number',
        'frozen_number',
        'marketable_number',
        'category_id',
        'brand_id',
        'published_at',
    ];

    protected $casts = [
        'image' => 'array'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function metas()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function images()
    {
        return $this->hasMany(Gallery::class);
    }

    public function values()
    {
        return $this->hasMany(CategoryValue::class);
    }
}
