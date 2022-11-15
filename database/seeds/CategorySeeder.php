<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            'Sport',
            'News',
            'Food',
            'Fashion',
            'Travel',
            'Music',
            'Movies',
            'Gaming',
            'Technology',
            'Politics',
            'Science',
            'Art',
            'History',
            'Nature'
        ];
        foreach($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category;
            $newCategory->slug = Str::slug($category, '-');
            $newCategory->save();
        }




    }
}
