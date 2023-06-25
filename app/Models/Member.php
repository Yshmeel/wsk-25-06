<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Member extends User
{
    use HasFactory;

    public $table = 'member';
    public $timestamps = false;

    public $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'photo',
        'teacher_id',
        'is_activated',
        'token'
    ];

    public $visible = [
        'id',
        'firstname',
        'lastname',
        'username',
        'email',
        'photo',
        'teacher_id',
        'is_activated',
        'token'
    ];

    /**
     * checks teacher id by checksum
     * excepts $id as 11-digit length string and starts with 7
     */
    public static function checkTeacherID($id) {
        if (strlen($id) != 11 || !str_starts_with($id, '7')) {
            return false;
        }

        $checksum = (int)substr($id, -1);
        $digits = str_split(substr($id, 0, 10));

        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += $digits[$i] * ($i + 1);
        }

        $calculatedChecksum = $sum % 11;
        return $calculatedChecksum === $checksum;
    }
}
