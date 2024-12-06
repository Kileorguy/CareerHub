<?php

namespace App\Http\Controllers;

use App\Models\CompanyJob;
use App\Models\JobSkill;
use App\Models\JobSkillMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyJobController extends Controller
{

    private function validateCompanyJob(Request $request)
    {
        $rules = [
            'job_name' => 'required|string|max:255',
            'job_description' => 'required|string|max:255',
            'job_level' => 'required|string|max:255',
            'job_skills' => 'required|string|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return null;
    }

    public function create(Request $req)
    {
        $validation_errors = $this->validateCompanyJob($req);
        if ($validation_errors) {
            return redirect()->back()
                ->with('message-title', "Add Job Failed")
                ->with('message', "All fields must not be empty")
                ->withInput();
        }

        $job_id = fake()->uuid();

        CompanyJob::create([
            'id' => $job_id,
            'company_id' => $req->company_id,
            'job_name' => $req->job_name,
            'job_description' => $req->job_description,
            'job_level' => $req->job_level,
        ]);

        $job_skills = json_decode($req->job_skills);

        foreach ($job_skills as $skill) {
            $curr_skill = JobSkill::whereRaw('LOWER(skill_name) = ?', [strtolower($skill)])->first();

            if (!$curr_skill) {
                $skill_id = fake()->uuid();
                JobSkill::create([
                    'id' => $skill_id,
                    'skill_name' => $skill
                ]);
                JobSkillMap::create([
                    'company_job_id' => $job_id,
                    'job_skill_id' => $skill_id
                ]);
            } else {
                JobSkillMap::create([
                    'company_job_id' => $job_id,
                    'job_skill_id' => $curr_skill->id
                ]);
            }
        }

        return redirect()->back()
            ->with('message-title', 'Add Job Success')
            ->with('message', 'Successfully added Job');
    }

    public function edit(Request $req)
    {
        $validation_errors = $this->validateCompanyJob($req);
        if ($validation_errors) {
            dd($validation_errors);
            return redirect()->back()
                ->with('message-title', "Add Job Failed")
                ->with('message', "All fields must not be empty")
                ->withInput();
        }

        $job = CompanyJob::where('id', $req->job_id)->first();

        $job->job_name = $req->job_name;
        $job->job_description = $req->job_description;
        $job->job_level = $req->job_level;

        $job->save();

        JobSkillMap::where('company_job_id', $req->job_id)->delete();

        foreach(json_decode($req->job_skills) as $skill) {
            $curr_skill = JobSkill::whereRaw('LOWER(skill_name) = ?', [$skill])->first();

            if (!$curr_skill) {
                $skill_id = fake()->uuid();
                JobSkill::create([
                    'id' => $skill_id,
                    'skill_name' => $skill
                ]);
                JobSkillMap::create([
                    'company_job_id' => $job->id,
                    'job_skill_id' => $skill_id
                ]);
            } else {
                JobSkillMap::create([
                    'company_job_id' => $job->id,
                    'job_skill_id' => $curr_skill->id
                ]);
            }
        }

        return redirect()
            ->back()
            ->with('message-title', 'Edit Job Success')
            ->with('message', 'Successfully edited Job');
    }

    public function delete(Request $req)
    {
        $job = CompanyJob::find($req->job_id);
        $job->delete();

        return redirect()->back()
            ->with('message-title', 'Delete Job Success')
            ->with('message', 'Successfully deleted Job');
    }
}
