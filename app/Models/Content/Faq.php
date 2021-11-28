<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory, softDeletes, Sluggable;

    protected $fillable = [
        'question',
        'answer',
        'slug',
        'status',
        'tags',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'question'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
