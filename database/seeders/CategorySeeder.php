<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'PHP', 'Laravel', 'Symfony', 'PHPUnit', 'Pest',
            'Livewire', 'JavaScript', 'Vue.js', 'React', 'Angular',
            'Node.js', 'Express.js', 'SQL', 'MySQL', 'PostgreSQL',
            'MongoDB', 'Git', 'Docker', 'Kubernetes', 'APIs RESTful',
            'GraphQL', 'Frontend Development', 'Backend Development',
            'DevOps', 'Control de Versiones', 'Bases de Datos',
            'Testing Automatizado', 'CSS', 'HTML', 'Sass/Less',
            'Webpack', 'Vite', 'Phaser 3', 'Svelte', 'Tiled',
            'Tailwind CSS', 'TypeScript', 'C#', 'Java', 'Python',
            'Unreal Engine', 'Unity', 'Azure DevOps', 'Azure Portal',
            'Terraform',
        ];

        foreach ($categories as $name) {
            DB::table('categories')->insertOrIgnore([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
