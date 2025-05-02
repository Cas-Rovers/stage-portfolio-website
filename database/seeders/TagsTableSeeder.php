<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'HTML'],
            ['name' => 'CSS'],
            ['name' => 'Sass'],
            ['name' => 'Bootstrap'],
            ['name' => 'JavaScript'],
            ['name' => 'PHP'],
            ['name' => 'Laravel'],
            ['name' => 'Git'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
