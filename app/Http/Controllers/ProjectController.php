<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPhotoType;
use App\Models\ProjectType;
use Illuminate\Support\Facades\URL;

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

    public function project($typeSlug, $slug)
    {
        $backUrl = (URL::previous() === route('project-type', $typeSlug))? URL::previous() : route('index');
        $projectType = ProjectType::where('slug', $typeSlug)->first();
        $project = $projectType->projects()->where('slug', $slug)->first();
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
