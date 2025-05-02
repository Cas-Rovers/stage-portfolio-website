<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            [
                'name' => 'HTML',
                'icon_data' => [
                    'type' => 'fa-brands',
                    'value' => 'fa-html5',
                ]
            ],
            [
                'name' => 'CSS',
                'icon_data' => [
                    'type' => 'fa-brands',
                    'value' => 'fa-css3-alt',
                ]
            ],
            [
                'name' => 'Sass',
                'icon_data' => [
                    'type' => 'fa-brands',
                    'value' => 'fa-sass',
                ]
            ],
            [
                'name' => 'Bootstrap',
                'icon_data' => [
                    'type' => 'fa-brands',
                    'value' => 'fa-bootstrap',
                ]
            ],
            [
                'name' => 'JavaScript',
                'icon_data' => [
                    'type' => 'fa-brands',
                    'value' => 'fa-js',
                ]
            ],
            [
                'name' => 'PHP',
                'icon_data' => [
                    'type' => 'fa-brands',
                    'value' => 'fa-php',
                ]
            ],
            [
                'name' => 'Laravel',
                'icon_data' => [
                    'type' => 'fa-brands',
                    'value' => 'fa-laravel',
                ]
            ],
            [
                'name' => 'Git',
                'icon_data' => [
                    'type' => 'fa-brands',
                    'value' => 'fa-git-alt',
                ]
            ]
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
