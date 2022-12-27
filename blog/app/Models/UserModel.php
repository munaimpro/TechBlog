<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKye = 'id';
    public $timestamps = false;
    public $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'phone',
        'role'
    ];
}
