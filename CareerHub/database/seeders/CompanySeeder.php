<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyJob;
use App\Models\JobSkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isNull;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws ConnectionException
     */
    public function run(): void
    {
        $main_url = 'http://127.0.0.1:5000';
        $response = Http::accept('application/json')->get($main_url.'/csv_data');

        if ($response->successful()) {
            $data = $response->json();
            foreach ($data as $row) {
                Company::create([
                    'id' => $row['id'],
                    'company_name' => $row['company'],
                    'country' => $row['search_country'],
                    'location' => $row['job_location'],
                    'city' => $row['search_city'],
                    'profile_picture' => fake()->imageUrl()
                ]);
                $job_id = fake()->uuid();
                CompanyJob::create([
                   'id' => $job_id,
                   'company_id' => $row['id'],
                   'job_name' => $row['search_position'],
                   'job_description' => $row['job_summary'],
                   'job_level' => $row['job_level'],
                ]);

                $response = Http::accept('application/json')->get($main_url.'/job_skills',['id'=>$row['id']]);
                $skills = $response->json();



//                dd($row['job_skills'] == null);
                if ($skills != ''){
                    foreach ($skills as $skill) {
                        JobSkill::create([
                            'id' => fake()->uuid(),
                            'job_id' => $job_id,
                            'skill_name' => $skill,

                        ]);
                    }
                }
            }
        } else {
            dd("Error fetching data from Flask API", $response->status(), $response->body());
        }

    }
}
