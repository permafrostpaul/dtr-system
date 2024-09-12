<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;

    // If your table name is not the plural form of the model name, define it here
    protected $table = 'remarks';

    // Define which attributes are mass assignable
    protected $fillable = [
        'user_id',
        'remarks',
    ];

    // Define relationships if necessary (example for user relationship)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
