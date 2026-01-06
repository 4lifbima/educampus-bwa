<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lecturer_id_number',
        'department',
        'status',
        'experience_years',
        'specialization',
        'bio',
    ];

    /**
     * Get the user that owns the lecturer profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the classes taught by the lecturer.
     */
    public function classRooms(): HasMany
    {
        return $this->hasMany(ClassRoom::class);
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'active' => 'bg-success-light text-success-dark',
            'on_leave' => 'bg-warning-light text-warning-dark',
            'inactive' => 'bg-error-light text-error-dark',
            default => 'bg-gray-100 text-gray-600',
        };
    }

    /**
     * Get formatted status
     */
    public function getFormattedStatus(): string
    {
        return match($this->status) {
            'active' => 'Active',
            'on_leave' => 'On Leave',
            'inactive' => 'Inactive',
            default => ucfirst($this->status),
        };
    }
}
