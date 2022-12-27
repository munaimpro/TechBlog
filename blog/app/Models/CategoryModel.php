<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_category';
    protected $primaryKye = 'catId';
    public $timeStamps = 'true';
    public $fillable = [
        'catName',
        'catImg'
    ];
}
