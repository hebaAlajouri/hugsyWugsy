<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoiceRecording extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'file_size',
        'file_type'
    ];

    /**
     * Get the full URL for the voice recording file
     *
     * @return string
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}