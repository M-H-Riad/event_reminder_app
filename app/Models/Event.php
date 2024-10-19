<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'reminder_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'status',
        'members',
    ];
}
