<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_comment';
    protected $parimaryKey = 'id';
    public $timestamps = false;
    protected $dates = ['date'];
    protected $fillable = [
        'postId',
        'userId',
        'userName',
        'userImg',
        'text',
        'userEmail',
        'userWebsite'
    ];

}
