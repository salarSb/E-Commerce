<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'public_mail';
    protected $fillable = [
        'user_ids',
        'subject',
        'body',
        'status',
        'published_at',
    ];
    protected $casts = [
        'user_ids' => 'array',
    ];

    public function files()
    {
        return $this->hasMany(EmailFile::class, 'public_mail_id');
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
