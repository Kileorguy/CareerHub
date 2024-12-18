<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CompanySeeder extends Seeder
{
  /**
   * Run the database seeds.
   * @throws ConnectionException
   */
  public function run(): void
  {
    $main_url = env('FLASK_HOST');
    $response = Http::accept('application/json')->get($main_url . '/job_data');

    if ($response->successful()) {
      $data = $response->json();
      foreach ($data as $row) {
        Company::create([
          'id' => $row['company_id'],
          'name' => $row['company'],
          'country' => $row['search_country'],
          'description' => fake()->paragraph(),
          'city' => $row['search_city'],
        ]);
        User::create([
          'id' => fake()->uuid(),
          'company_id' => $row['company_id'],
          'email' => fake()->unique()->safeEmail,
          'password' => fake()->password,
          'role' => 'Company',
          'profile_link' => fake()->imageUrl()
        ]);
        Job::create([
          'id' => $row["job_id"],
          'company_id' => $row['company_id'],
          'job_name' => $row['job_name'],
          'job_description' => $row['job_summary'],
          'job_level' => $row['job_level'],
        ]);
      }
    } else {
      dd("Error fetching data from Flask API", $response->status(), $response->body());
    }
  }
}
