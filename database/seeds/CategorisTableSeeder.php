<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();

        $category->id = "1";
        $category->name = "Quan ao nam";
        $category->save();

        $category = new Category();
        $category->id = "2";
        $category->name = "Quan ao Nu";
        $category->save();
    }
}
