<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'color_id',
        'guarantee_id',
        'number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class);
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    // product price + color price + guarantee price
    public function getProductPriceAttribute()
    {
        $guaranteePriceIncrease = empty($this->guarantee_id) ? 0 : $this->guarantee->price_increase;
        $colorPriceIncrease = empty($this->color_id) ? 0 : $this->color->price_increase;
        return $this->product->price + $guaranteePriceIncrease + $colorPriceIncrease;
    }

    // product price * number
    public function getTotalProductPriceAttribute()
    {
        return $this->number * $this->product_price;
    }

    // product price * (discount percentage / 100)
    public function getProductDiscountAttribute()
    {
        $amazingSale = $this->product->amazingSales()->validAmazingSales()->first();
        return empty($amazingSale) ? 0 : $this->product_price * ($amazingSale->percentage / 100);
    }

    // number * (product price - product discount)
    public function getFinalPriceAttribute()
    {
        return $this->number * ($this->product_price - $this->product_discount);
    }

    // number * product discount
    public function getFinalDiscountAttribute()
    {
        return $this->number * $this->product_discount;
    }
}
