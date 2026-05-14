<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = [
        'ticket_number', 'name', 'email', 'phone',
        'issue', 'message', 'user_type', 'user_id', 'status',
    ];

    public static function generateTicketNumber(): string
    {
        do {
            $number = 'DT' . rand(10000, 99999);
        } while (self::where('ticket_number', $number)->exists());

        return $number;
    }
    public function replies()
{
    return $this->hasMany(TicketReply::class, 'ticket_id');
}

public function latestReply()
{
    return $this->hasOne(TicketReply::class, 'ticket_id')->latest();
}
}