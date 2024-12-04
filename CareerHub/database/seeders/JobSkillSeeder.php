<?php

namespace Database\Seeders;

use App\Models\JobSkill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class JobSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $main_url = env('FLASK_HOST');
        $response = Http::accept('application/json')->get($main_url . '/skill_data');
        if ($response->successful()) {
            $data = $response->json();
            foreach ($data as $row) {
                JobSkill::create([
                    'id' => $row['skill_id'],
                    'skill_name' => $row['skill_name']
                ]);
            }
        } else {
            dd("Error fetching data from Flask API", $response->status(), $response->body());
        }
    }

}
