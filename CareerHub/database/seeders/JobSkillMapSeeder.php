<?php

namespace Database\Seeders;

use App\Models\JobSkillMap;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class JobSkillMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $main_url = env('FLASK_HOST');
        $response = Http::accept('application/json')->get($main_url . '/job_skill_map_data');
        if ($response->successful()) {
            $data = $response->json();
            foreach ($data as $row) {
                JobSkillMap::create([
                    'company_job_id' => $row['job_id'],
                    'job_skill_id' => $row['skill_id']
                ]);
            }
        } else {
            dd("Error fetching data from Flask API", $response->status(), $response->body());
        }
    }

}
