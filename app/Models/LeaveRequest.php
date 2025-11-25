<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_type_id', 
        'start_date',
        'end_date',
        'total_days',
        'reason',
        'contact_number',
        'emergency_contact',
        'handover_notes',
        'status',
        'rejection_reason',
        'action_by',
        'action_at'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'action_at' => 'datetime'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }

    public function actionBy()
    {
        return $this->belongsTo(User::class, 'action_by');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Helpers
    public function getStatusBadgeClass()
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'cancelled' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Check if leave request can be edited
     */
    public function canBeEdited()
    {
        return $this->status === 'pending' && $this->start_date > now();
    }

    /**
     * Check if leave request can be cancelled
     */
    public function canBeCancelled()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if leave request can be retrieved
     */
    public function canBeRetrieved()
    {
        return $this->status === 'cancelled' && $this->start_date > now();
    }
}