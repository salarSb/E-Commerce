<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'amount',
        'amount_type',
        'discount_ceiling',
        'type',
        'status',
        'start_date',
        'end_date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeValidCoupons($query)
    {
        return $query
            ->where('status', 1)
            ->where('end_date', '>', now())
            ->where('start_date', '<', now());
    }

    public function scopeValidUserCoupons($query)
    {
        return $query
            ->where('status', 1)
            ->where('end_date', '>', now())
            ->where('start_date', '<', now())
            ->where('user_id', auth()->user()->id);
    }
}
