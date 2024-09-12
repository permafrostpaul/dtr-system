<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  // Specify the table name if it does not follow Laravel's naming conventions
  protected $table = 'events';

  // Specify which attributes are mass assignable
  protected $fillable = ['title', 'start', 'end'];
}
