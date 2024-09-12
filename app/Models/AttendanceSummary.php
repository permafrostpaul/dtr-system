<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceSummary extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   
    use HasFactory;

    protected $table = 'attendance_summary';

    protected $fillable = [
        'user_id',
        'date',
        'time_in',
        'time_out',
        'shift',
        'remarks',
    ];
}
