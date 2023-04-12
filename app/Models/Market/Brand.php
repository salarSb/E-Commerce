<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'persian_name',
        'original_name',
        'slug',
        'logo',
        'status',
        'tags',
    ];

    protected $casts = [
        'logo' => 'array',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'original_name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeSearch($query, $keywords)
    {
        $keywords = explode(' ', $keywords);
        foreach ($keywords as $keyword) {
            $query->where('persian_name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('original_name', 'LIKE', '%' . $keyword . '%');
        }
        return $query;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
