<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ['html', 'Css', 'JavaScript', 'Vite/VueJS', 'php', 'Laravel', 'Laravel/Breeze'];


        foreach ($technologies as $technology) {
            $newTech = new Technology();
            $newTech->name = $technology;
            $newTech->slug = Str::slug($technology);
            $newTech->save();

        }
    }
}
