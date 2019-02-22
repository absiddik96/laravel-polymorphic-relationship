<?php

use Illuminate\Database\Seeder;

class TagsVideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tags')->delete();
        \DB::table('videos')->delete();
        factory(App\Tag::class, 5)->create();
        factory(App\Video::class, 10)->create();
    }
}
