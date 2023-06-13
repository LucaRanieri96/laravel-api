<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(Faker $faker)
  {
    for ($i = 0; $i < 2; $i++) {
      $project = new Project();
      $project->slug = Project::generateSlug($project->name);
      $project->repoUrl = Project::generateRepoUrl($project->slug);
      $project->startingDate = date("Y-m-d") . " " . date("H:i:s");
      $project->cover_image = 'placeholders/' . $faker->image('storage/app/public/placeholders/', fullPath: false, category: 'Project', format: 'jpg');
      $project->save();
    }
  }
}