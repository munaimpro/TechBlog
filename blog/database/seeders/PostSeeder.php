<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_post')->insert([
            'posttitle'=> 'This is new post',
            'postcontent'=> 'This is post content',
            'catId'=> '4',
            'postedby'=> 'Munaim Khan'
        ]);
    }
}
