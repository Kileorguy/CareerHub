<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobSkill;
use App\Models\JobSkillMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    private const VALIDATION_RULES = [
        'job_name' => 'required|string|max:255',
        'job_description' => 'required|string|max:255',
        'job_level' => 'required|string|max:255',
        'job_skills' => 'required|string|max:255'
    ];

    private const ERROR_MESSAGES = [
        'create_failed' => [
            'title' => 'Add Job Failed',
            'message' => 'All fields must not be empty'
        ],
        'create_success' => [
            'title' => 'Add Job Success',
            'message' => 'Successfully added Job'
        ],
        'edit_success' => [
            'title' => 'Edit Job Success',
            'message' => 'Successfully edited Job'
        ],
        'delete_success' => [
            'title' => 'Delete Job Success',
            'message' => 'Successfully deleted Job'
        ]
    ];

    private function validateRequest(Request $request)
    {
        return Validator::make($request->all(), self::VALIDATION_RULES)->validate();
    }

    private function createOrUpdateJobSkills(array $skills, string $jobId)
    {
        $skillMaps = [];

        foreach ($skills as $skillName) {
            $skillName = trim(strtolower($skillName));

            $skill = JobSkill::firstOrCreate(
                ['skill_name' => $skillName],
                ['id' => fake()->uuid()]
            );

            $skillMaps[] = [
                'job_id' => $jobId,
                'job_skill_id' => $skill->id
            ];
        }

        JobSkillMap::insert($skillMaps);
    }

    private function parseJobSkills(string $skillsJson)
    {
        try {
            return json_decode($skillsJson, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'job_skills' => ['Invalid JSON format for job skills']
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            $this->validateRequest($request);
            $skills = $this->parseJobSkills($request->job_skills);

            $job = Job::create([
                'id' => fake()->uuid(),
                'company_id' => $request->company_id,
                'job_name' => $request->job_name,
                'job_description' => $request->job_description,
                'job_level' => $request->job_level,
            ]);

            $this->createOrUpdateJobSkills($skills, $job->id);

            return redirect()->back()
                ->with('message-title', self::ERROR_MESSAGES['create_success']['title'])
                ->with('message', self::ERROR_MESSAGES['create_success']['message']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message-title', self::ERROR_MESSAGES['create_failed']['title'])
                ->with('message', $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request)
    {
        try {
            $this->validateRequest($request);
            $skills = $this->parseJobSkills($request->job_skills);

            $job = Job::findOrFail($request->job_id);
            $job->update([
                'job_name' => $request->job_name,
                'job_description' => $request->job_description,
                'job_level' => $request->job_level,
            ]);

            JobSkillMap::where('job_id', $job->id)->delete();
            $this->createOrUpdateJobSkills($skills, $job->id);

            return redirect()->back()
                ->with('message-title', self::ERROR_MESSAGES['edit_success']['title'])
                ->with('message', self::ERROR_MESSAGES['edit_success']['message']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message-title', self::ERROR_MESSAGES['create_failed']['title'])
                ->with('message', $e->getMessage())
                ->withInput();
        }
    }

    public function delete(Request $request)
    {
        try {
            $job = Job::findOrFail($request->job_id);
            $job->delete();

            return redirect()->back()
                ->with('message-title', self::ERROR_MESSAGES['delete_success']['title'])
                ->with('message', self::ERROR_MESSAGES['delete_success']['message']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message-title', 'Delete Job Failed')
                ->with('message', $e->getMessage());
        }
    }

    public static function getJobById($company_id, $includes=[])
    {
        $query = Job::where('company_id', $company_id)->with([...$includes]);
        return $query->get();
    }
}
