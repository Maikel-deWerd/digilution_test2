<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();
        Post::truncate();
        Category::truncate();

        $user = User::factory()->create([
            'name' => 'Maikel'
        ]);
        Post::factory(5)->create([
            'user_id' => $user->id
        ]);

        /* //\App\Models\User::factory(10)->create();
        $user = User::factory()->create();

        $personal = Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        $family = Category::create([
            'name' => 'Family',
            'slug' => 'family'
        ]);

        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => 'My Family Post',
            'excerpt' => 'Excerpt for my post',                                            
            'slug' => "my-family-post",                                                                                                               
            'body' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry."
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $personal->id,
            'title' => 'My Personal Post',
            'excerpt' => 'Excerpt for my post',                                            
            'slug' => "my-personal-post",                                                                                                               
            'body' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry."
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]); */
    }
}
