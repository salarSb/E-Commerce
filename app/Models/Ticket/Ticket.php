<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'subject',
        'description',
        'status',
        'seen',
        'reference_id',
        'user_id',
        'category_id',
        'priority_id',
        'ticket_id',
    ];

    protected $with = [
        'children',
        'ticketFile',
        'admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(TicketAdmin::class, 'reference_id');
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function parent()
    {
        return $this->belongsTo($this, 'ticket_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany($this, 'ticket_id')->with('children');
    }

    public function ticketFile()
    {
        return $this->hasOne(TicketFile::class);
    }
}
