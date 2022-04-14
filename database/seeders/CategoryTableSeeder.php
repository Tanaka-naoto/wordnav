<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate(); //2回目実行の際にシーダー情報をクリア
        DB::table('categories')->insert([
            'name' => '家族',
        ]);
        DB::table('categories')->insert([
            'name' => '友達',
        ]);
        DB::table('categories')->insert([
            'name' => '学校',
        ]);
        DB::table('categories')->insert([
            'name' => '会社',
        ]);
        DB::table('categories')->insert([

            'name' => '私生活',
        ]);
        DB::table('categories')->insert([

            'name' => 'その他',
        ]);
    }
}
