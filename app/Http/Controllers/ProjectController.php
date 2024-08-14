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
        $projectType = ProjectType::where('slug', $slug)->first();

        return view('project-type')
            ->with('projects', $projectType);
    }
}
