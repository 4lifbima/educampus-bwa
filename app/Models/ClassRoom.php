<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'lecturer_id',
        'room',
        'capacity',
        'schedule_day',
        'schedule_time',
        'status',
        'credits',
        'description',
    ];

    /**
     * Get the lecturer that teaches the class.
     */
    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }

    /**
     * Get the students enrolled in the class.
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'class_student')
            ->withPivot('enrolled_at', 'grade', 'status')
            ->withTimestamps();
    }

    /**
     * Get the attendances for the class.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'active' => 'bg-success-light text-success-dark',
            'cancelled' => 'bg-error-light text-error-dark',
            'completed' => 'bg-gray-100 text-gray-600',
            default => 'bg-gray-100 text-gray-600',
        };
    }

    /**
     * Get the enrollment count.
     */
    public function getEnrollmentCount(): int
    {
        return $this->students()->count();
    }
}
