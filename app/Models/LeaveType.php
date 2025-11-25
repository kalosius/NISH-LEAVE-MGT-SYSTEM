<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'max_days',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the leave requests for this leave type
     */
    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    /**
     * Get the icon class for this leave type
     */
    public function getIconClass()
    {
        return match(strtolower($this->name)) {
            'annual' => 'fas fa-umbrella-beach',
            'sick' => 'fas fa-procedures',
            'emergency' => 'fas fa-exclamation-triangle',
            'maternity' => 'fas fa-baby',
            'paternity' => 'fas fa-male',
            'casual' => 'fas fa-calendar-alt',
            default => 'fas fa-calendar-alt'
        };
    }

    /**
     * Get the color class for this leave type
     */
    public function getColorClass()
    {
        return match(strtolower($this->name)) {
            'annual' => 'blue',
            'sick' => 'green', 
            'emergency' => 'red',
            'maternity' => 'pink',
            'paternity' => 'blue',
            'casual' => 'purple',
            default => 'gray'
        };
    }

    /**
     * Get the badge class for this leave type
     */
    public function getBadgeClass()
    {
        $color = $this->getColorClass();
        return "bg-{$color}-100 text-{$color}-800";
    }

    /**
     * Check if this leave type has unlimited days
     */
    public function isUnlimited()
    {
        return is_null($this->max_days);
    }

    /**
     * Scope for active leave types
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}