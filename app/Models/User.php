<?php

namespace App\Models;

use App\Models\Content\Comment;
use App\Models\Content\Post;
use App\Models\Market\Address;
use App\Models\Market\CartItem;
use App\Models\Market\CashPayment;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use App\Models\Market\Payment;
use App\Models\Market\Product;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use App\Models\Ticket\TicketFile;
use App\Traits\Permissions\HasPermission;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Nagy\LaravelRating\Traits\CanRate;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Sluggable;
    use softDeletes;
    use HasPermission;
    use CanRate;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'mobile',
        'password',
        'first_name',
        'last_name',
        'profile_photo_path',
        'activation',
        'user_type',
        'status',
        'slug',
        'national_code',
        'email_verified_at',
        'mobile_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'full_name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function ticketAdmin()
    {
        return $this->hasOne(TicketAdmin::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticketFiles()
    {
        return $this->hasMany(TicketFile::class);
    }

    public function onlinePayments()
    {
        return $this->hasMany(OnlinePayment::class);
    }

    public function offlinePayments()
    {
        return $this->hasMany(OfflinePayment::class);
    }

    public function CashPayments()
    {
        return $this->hasMany(CashPayment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function otps()
    {
        return $this->hasMany(Otp::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function isPurchasedProduct($productId)
    {
//        // TODO : consider paid payment status and fill payment fields in order instance.
        return $this->orders()
                ->where('order_status', 3)
                ->whereHas('orderItems', function ($query) use ($productId) {
                    $query->where('product_id', $productId);
                })->count() > 0;
    }
}
