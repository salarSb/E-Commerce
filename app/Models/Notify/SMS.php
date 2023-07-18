<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SMS extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'public_sms';
    protected $fillable = [
        'user_ids',
        'title',
        'body',
        'status',
        'published_at',
    ];
    protected $casts = [
        'user_ids' => 'array',
    ];

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
