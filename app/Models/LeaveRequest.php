<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;



    // Define fillable properties
    protected $fillable = [
        'user_id',
        'date_from',
        'date_to',
        'leave_type',
        'duration',
        'reason',
        'leave_number'
    ];

    // Define the relationship to the User model (assuming each leave request belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
