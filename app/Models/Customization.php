<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'color',
        'text',
        'accessories',
        'special_instructions',
        'voice_note', // Add this
    ];
    

    protected $casts = [
        'accessories' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function voiceRecording()
    {
        return $this->hasOne(VoiceRecording::class);
    }
}