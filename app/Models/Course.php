<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public $table = 'courses';
    public $timestamps = false;

    public $fillable = [
        'title',
        'description',
        'date_time',
        'duration_days',
        'location',
        'seats',
        'instructor_name'
    ];

    public $visible = [
        'id',
        'title',
        'description',
        'date_time',
        'duration_days',
        'location',
        'seats',
        'instructor_name'
    ];
}
