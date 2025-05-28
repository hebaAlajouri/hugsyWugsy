<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class BearCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'owner_name',
        'bear_name',
        'adoption_date',
        'certificate_number',
        'is_active'
    ];

    protected $casts = [
        'adoption_date' => 'date',
        'is_active' => 'boolean'
    ];

    // Boot method to generate certificate number automatically
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($certificate) {
            if (empty($certificate->certificate_number)) {
                $certificate->certificate_number = $certificate->generateCertificateNumber();
            }
        });
    }

    /**
     * Get the user that owns the certificate
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate a unique certificate number
     */
    public function generateCertificateNumber(): string
    {
        do {
            $number = 'BEAR-' . strtoupper(uniqid()) . '-' . rand(1000, 9999);
        } while (self::where('certificate_number', $number)->exists());
        
        return $number;
    }

    /**
     * Get formatted adoption date
     */
    public function getFormattedAdoptionDateAttribute(): string
    {
        return $this->adoption_date->format('F j, Y');
    }

    /**
     * Get raw date for form input
     */
    public function getRawAdoptionDateAttribute(): string
    {
        return $this->adoption_date->format('Y-m-d');
    }

    /**
     * Scope to get certificates for specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope to get active certificates only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to search certificates
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('owner_name', 'like', '%' . $search . '%')
                    ->orWhere('bear_name', 'like', '%' . $search . '%')
                    ->orWhere('certificate_number', 'like', '%' . $search . '%');
    }

    /**
     * Scope to get recent certificates
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days));
    }

    /**
     * Check if this certificate belongs to the given user
     */
    public function belongsToUser($userId): bool
    {
        return $this->user_id == $userId;
    }
}
