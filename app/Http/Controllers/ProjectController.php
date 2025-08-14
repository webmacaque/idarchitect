<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPhotoType;
use App\Models\ProjectType;
use App\Models\Employee;
use Illuminate\Support\Facades\URL;

class ProjectController extends Controller
{

    public function index()
    {
        $projectTypes = ProjectType::orderBy('sort', 'asc')->get();
        $topProjects = Project::mainTop()->get();
        $employees = Employee::orderBy('sorting_order', 'asc')->get();

        return view('index')
            ->with('topProjects', $topProjects)
            ->with('projectTypes', $projectTypes)
            ->with('employees', $employees);
    }

    public function projectType($slug)
    {
        $projectTypes = ProjectType::orderBy('sort', 'asc')->get();
        $projectType = ProjectType::where('slug', $slug)->firstOrFail();
        $projects = Project::where('project_type_id', $projectType->id)
            ->published()
            ->ordered()
            ->paginate(12)
            ->onEachSide(PHP_INT_MAX);

        return view('project-type')
            ->with('projectTypes', $projectTypes)
            ->with('currentType', $projectType)
            ->with('currentProjects', $projects);
    }

    public function project($typeSlug, $slug)
    {
        $backUrl = (URL::previous() === route('project-type', $typeSlug))? URL::previous() : route('index') . '#' . $typeSlug;
        $projectType = ProjectType::where('slug', $typeSlug)->firstOrFail();
        $project = $projectType->projects()->where('slug', $slug)->firstOrFail();
        $photoTypes = ProjectPhotoType::orderBy('sort')->get();
        $photos = [];
        foreach ($photoTypes as $type) {
            $photos[$type->slug] = $project->photosByType($type->slug)->get();
        }

        return view('project')
            ->with('backUrl', $backUrl)
            ->with('projectType', $projectType)
            ->with('project', $project)
            ->with('photoTypes', $photoTypes)
            ->with('photos', $photos);
    }
}
