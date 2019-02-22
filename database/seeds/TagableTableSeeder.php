<?php

use Illuminate\Database\Seeder;

class TagableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('tagables')->delete();
        $tags = App\Tag::pluck('id')->all();
        $posts = App\Post::all();
        $videos = App\Video::all();

        $numberOfTags = count($tags);
        foreach ($posts as $p)
        {
            for ($i = 0; $i < rand(1, $numberOfTags); $i++)
            {
                $tag = $tags[$i];
                $p->tags()->attach($tag);
            }
        }

        foreach ($videos as $v)
        {
            for ($i = 0; $i < rand(1, $numberOfTags); $i++)
            {
                $tag = $tags[$i];
                $v->tags()->attach($tag);
            }
        }
    }
}
