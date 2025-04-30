<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array de categorías de tecnologías de desarrollo
        $categories = [
            ['name' => 'PHP', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Laravel', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Symfony', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'PHPUnit', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Pest', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Livewire', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'JavaScript', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Vue.js', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'React', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Angular', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Node.js', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Express.js', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'SQL', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'MySQL', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'PostgreSQL', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'MongoDB', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Git', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Docker', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Kubernetes', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'APIs RESTful', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'GraphQL', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Frontend Development', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Backend Development', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'DevOps', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Control de Versiones', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Bases de Datos', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Testing Automatizado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'CSS', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'HTML', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sass/Less', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Webpack', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Vite', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        // Inserta los datos en la tabla 'categories'
        DB::table('categories')->insert($categories);
    }
}
