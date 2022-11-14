<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        for ($i = 0; $i < 20; $i++) {
            # code...
            $el = new Post();
            $el->title = $faker->sentence();
            $el->content= $faker->text();
            $el->save();
        }
    }
}
