<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'yob',
        'is_banned',
    ];
    protected $table = 'member';
    use HasFactory;
}
