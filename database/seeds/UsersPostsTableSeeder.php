<?php

use Illuminate\Database\Seeder;

class UsersPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('posts')->delete();
        \DB::table('users')->delete();

        factory(App\User::class, 5)->create()->each(function ($u){
            $u->posts()
                ->saveMany(
                    factory(App\Post::class, rand(1, 5))->make()
                );
        });

    }
}
