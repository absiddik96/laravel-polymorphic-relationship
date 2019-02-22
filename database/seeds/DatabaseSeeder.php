<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersPostsTableSeeder::class);
        $this->call(ImageableTableSeeder::class);
        $this->call(TagsVideosTableSeeder::class);
        $this->call(TagableTableSeeder::class);
    }
}
