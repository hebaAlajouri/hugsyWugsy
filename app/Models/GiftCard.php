<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'template',
        'recipient_name',
        'message',
        'sender_name',
        'font_style',
        'amount',
        'delivery_method',
    ];
}
