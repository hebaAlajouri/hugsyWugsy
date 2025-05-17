<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    
    protected $fillable = ['owner_name', 'bear_name', 'adoption_date'];
    
    protected $casts = [
        'adoption_date' => 'date',
    ];
}