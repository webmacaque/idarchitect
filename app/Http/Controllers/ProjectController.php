<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $projectTypes = ProjectType::orderBy('sort', 'asc')->get();
        $topProjects = Project::mainTop()->get();

        return view('index')
            ->with('topProjects', $topProjects)
            ->with('projectTypes', $projectTypes);
    }

    public function projectType($slug)
    {
        $projectTypes = ProjectType::orderBy('sort', 'asc')->get();
        $projectType = ProjectType::where('slug', $slug)->first();
        $projects = Project::where('project_type_id', $projectType->id)
            ->published()
            ->ordered()
            ->paginate(12);

        return view('project-type')
            ->with('projectTypes', $projectTypes)
            ->with('currentType', $projectType)
            ->with('currentProjects', $projects);
    }
}
