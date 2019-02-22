<?php

use Illuminate\Database\Seeder;
use App\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('posts')->delete();
        $users = User::all();
        foreach ($users as $u) {
            $u->posts()
                ->saveMany(
                    factory(App\Post::class, rand(1, 5))->make()
                );
        }
    }
}
