<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 5; $i++) {
            $user = User::create([
                'id' => fake()->uuid(),
                'email' => fake()->email,
                'password' => fake()->password,
                'first_name' => fake()->firstName,
                'last_name' => fake()->lastName,
                'short_description' => fake()->text(60),
                'github_link' => fake()->url(),
                'portfolio_link' => fake()->url(),
                'role' => fake()->company(),
                'profile_link' => fake()->imageUrl()
            ]);
            $user->certificates()->create([
                'id' => fake()->uuid(),
                'certificate_name' => fake()->text(20),
                'image_link' => fake()->imageUrl(),
                'detail'=> fake()->text(60),
                'company' => fake()->company(),
                'issued_date' => fake()->date(),
            ]);
            $user->awards()->create([
                'id' => fake()->uuid(),
                'award_name' => fake()->text(20),
                'award_detail' => fake()->text(60),
                'company' => fake()->company(),
                'image_link' => fake()->imageUrl(),
                'issued_date' => fake()->date(),
            ]);
            $user->experiences()->create([
                'id' => fake()->uuid(),
                'company' => fake()->company(),
                'position' => fake()->text(20),
                'description' => fake()->text(60),
                'start_date' => fake()->date(),
                'end_date' => fake()->date()
            ]);
            $user->skills()->create([
                'id' => fake()->uuid(),
                'skill_name' => fake()->text(20),
            ]);

            $user->educations()->create([
                'id' => fake()->uuid(),
                'education_name' => fake()->text(20),
                'major'=>fake()->text(20),
                'gpa' => fake()->randomFloat(0,4),
                'start_date' => fake()->date(),
                'end_date' => fake()->date()
            ]);

            $user->projects()->create([
                'id' => fake()->uuid(),
                'project_name' => fake()->text(20),
                'project_detail' => fake()->text(60),
                'date' => fake()->date()
            ]);
        }
    }
}
