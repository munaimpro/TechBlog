<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_message';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message'
    ];
    protected $dates = ['date'];
}
