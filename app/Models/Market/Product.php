<?php

namespace App\Models\Market;

use App\Models\Content\Comment;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nagy\LaravelRating\Traits\Rateable;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable, Rateable;

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

    public function guarantees()
    {
        return $this->hasMany(Guarantee::class);
    }

    public function values()
    {
        return $this->hasMany(CategoryValue::class);
    }

    public function amazingSales()
    {
        return $this->hasMany(AmazingSale::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function compares()
    {
        return $this->belongsToMany(Compare::class);
    }

    public function scopeSearch($query, $keywords)
    {
        $keywords = explode(' ', $keywords);
        foreach ($keywords as $keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('tags', 'LIKE', '%' . $keyword . '%')
                ->orWhereHas('category', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('tags', 'LIKE', '%' . $keyword . '%')
                        ->orWhereHas('parent', function ($query) use ($keyword) {
                            $query->where('name', 'LIKE', '%' . $keyword . '%')
                                ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                                ->orWhere('tags', 'LIKE', '%' . $keyword . '%');
                        })->orWhereHas('children', function ($query) use ($keyword) {
                            $query->where('name', 'LIKE', '%' . $keyword . '%')
                                ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                                ->orWhere('tags', 'LIKE', '%' . $keyword . '%');
                        });
                })->orWhereHas('metas', function ($query) use ($keyword) {
                    $query->where('meta_value', 'LIKE', '%' . $keyword . '%');
                });
        }
        return $query;
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

}
