<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyJob;
use App\Models\JobSkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $id = fake()->uuid();
            $companyy = Company::create([
                'id' => $id,
                'company_name' => fake()->company(),
                'country' => fake()->country(),
                'location' => fake()->state(),
                'city' => fake()->city(),
                'profile_picture' => fake()->imageUrl(),
            ]);
            for ($j = 0; $j < 3; $j++) {
                $job_id = fake()->uuid();
                $a = [
                    'id' => $job_id,
                    'company_id' => $id,
                    'job_name' => fake()->name(),
                    'job_description' => fake()->text(20),
                    'job_level' => fake()->text(20)
                ];
                $job = CompanyJob::create($a);

                JobSkill::create([
                    'id' => fake()->uuid(),
                    'job_id' => $job_id,
                    'skill_name' => fake()->name(),
                ]);

            }
        }
    }
}
