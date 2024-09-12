<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workstation extends Model
{
    use HasFactory;

    // Specify the table if not following Laravel's naming convention
    protected $table = 'workstations';

    // Define the fillable properties
    protected $fillable = ['name'];
}
