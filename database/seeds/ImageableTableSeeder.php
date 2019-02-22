<?php

use Illuminate\Database\Seeder;

class ImageableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('images')->delete();
        $users = App\User::all();
        $posts = App\Post::all();

        foreach ($users as $u) {
            $u->image()->save(
                factory(App\Image::class)->make()
            );
        }

        foreach ($posts as $p) {
            $p->images()->saveMany(
                factory(App\Image::class, rand(1,3))->make()
            );
        }
    }
}
