<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->delete();
        factory('LaravelCommerce\Category',10)->create();

    }
}