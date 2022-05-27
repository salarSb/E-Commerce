<?php

namespace App\Models\Content;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'body',
        'parent_id',
        'author_id',
        'commentable_id',
        'commentable_type',
        'approved',
        'status',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function scopePostComments($query)
    {
        return $query->where('commentable_type', 'App\Models\Content\Post');
    }

    public function scopeProductComments($query)
    {
        return $query->where('commentable_type', 'App\Models\Market\Product');
    }

    public function scopeValidComments($query)
    {
        return $query->where('status', 1)->where('approved', 1)->where('parent_id', null);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function answers()
    {
        return $this->hasMany($this, 'parent_id');
    }
}
