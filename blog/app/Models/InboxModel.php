<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InboxModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_message';
    protected $primaryKye = 'id';
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
