<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyJob;
use App\Models\JobSkill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws ConnectionException
     */
    public function run(): void
    {
        $main_url = env('FLASK_HOST');
        $response = Http::accept('application/json')->get($main_url . '/csv_data');

        if ($response->successful()) {
            $data = $response->json();
            foreach ($data as $row) {
                Company::create([
                    'id' => $row['id'],
                    'name' => $row['company'],
                    'country' => $row['search_country'],
                    'city' => $row['search_city'],
                    'profile_picture' => fake()->imageUrl()
                ]);
                User::create([
                    'id' => fake()->uuid(),
                    'company_id' => $row['id'],
                    'email' => fake()->email,
                    'password' => fake()->password,
                    'role' => 'Company',
                    'profile_link' => fake()->imageUrl()
                ]);
                $job_id = fake()->uuid();
                CompanyJob::create([
                    'id' => $job_id,
                    'company_id' => $row['id'],
                    'job_name' => $row['search_position'],
                    'job_description' => $row['job_summary'],
                    'job_level' => $row['job_level'],
                ]);
            }
        } else {
            dd("Error fetching data from Flask API", $response->status(), $response->body());
        }

        $response = Http::accept('application/json')->get($main_url . '/job_skills');
        if ($response->successful()) {
            $skills = $response->json();
            foreach ($skills as $skill) {
                JobSkill::create([
                    'id' => fake()->uuid(),
                    'job_id' => $job_id,
                    'skill_name' => $skill,
                ]);
            }
        } else {
            dd("Error fetching data from Flask API", $response->status(), $response->body());
        }
    }
}
