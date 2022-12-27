<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_post';
    protected $primaryKye = 'id';
    public $timestamps = false;
    public $fillable = [
        'posttitle',
        'postcontent',
        'catId',
        'postImg',
        'posttags',
        'postview',
        'poststatus'
    ];
    protected $dates = ['posttime'];
}
