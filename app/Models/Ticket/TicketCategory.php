<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketCategory extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'status',
    ];

    public function scopeValid($query)
    {
        return $query->where('status', 1);
    }
}
