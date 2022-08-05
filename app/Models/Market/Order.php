<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
        'create_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function commonDiscount()
    {
        return $this->belongsTo(CommonDiscount::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getPaymentStatusTextAttribute()
    {
        return match ($this->payment_status) {
            0 => 'پرداخت نشده',
            1 => 'پرداخت شده',
            2 => 'باطل شده',
            3 => 'برگشت داده شده',
        };
    }

    public function getPaymentTypeTextAttribute()
    {
        return match ($this->payment_type) {
            0 => 'آنلاین',
            1 => 'آفلاین',
            2 => 'در محل',
        };
    }

    public function getDeliveryStatusTextAttribute()
    {
        return match ($this->delivery_status) {
            0 => 'ارسال نشده',
            1 => 'درحال ارسال',
            2 => 'ارسال شده',
            3 => 'تحویل داده شده',
        };
    }

    public function getOrderStatusTextAttribute()
    {
        return match ($this->order_status) {
            0 => 'بررسی نشده',
            1 => 'در انتظار تایید',
            2 => 'تایید نشده',
            3 => 'تایید شده',
            4 => 'باطل شده',
            5 => 'مرجوعی',
        };
    }
}
