<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPhotoType;
use App\Models\ProjectType;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminProjectController extends Controller
{

    public function projects(Request $request)
    {
        $projectTypes = ProjectType::orderBy('sort', 'asc')->get();
        $projects = $this->getProjects($request)->paginate(10)->onEachSide(PHP_INT_MAX);
        $backgrounds = ['', 'gray'];
        $typesBgs = [];
        foreach ($projectTypes as $key=>$type) {
            $typesBgs[$type->slug] = $backgrounds[$key];
        }
        return view('admin.projects')
            ->with('projectTypes', $projectTypes)
            ->with('projects', $projects)
            ->with('typesBgs', $typesBgs)
            ->with('filterType', $request->type)
            ->with('filterName', $request->project_name);
    }

    private function getProjects(Request $request) {
        $projects = Project::orderByDesc('id');
        if ($request->has('type')) {
            if ($request->type == 'home_page') {
                $projects = $projects->where('home_page', true);
            } else if (!empty($request->type)){
                $projects = $projects->where('project_type_id', $request->type);
            }
        }

        if ($request->has('project_name')) {
            $projects = $projects->whereRaw('LOWER(name) LIKE ?', [strtolower("%{$request->project_name}%")]);
        }
        return $projects;
    }

    public function createForm()
    {
        $projectTypes = ProjectType::orderBy('sort')->get();
        $photoTypes = ProjectPhotoType::orderBy('sort')->get();

        $currentYear = Carbon::now()->year;
        return view('admin.project-create-form')
            ->with('projectTypes', $projectTypes)
            ->with('photoTypes', $photoTypes)
            ->with('currentYear', $currentYear);
    }

    public function editForm($id)
    {
        $projectTypes = ProjectType::orderBy('sort')->get();
        $photoTypes = ProjectPhotoType::orderBy('sort')->get();
        $project = Project::find($id);

        $currentYear = Carbon::now()->year;
        return view('admin.project-edit-form')
            ->with('projectTypes', $projectTypes)
            ->with('photoTypes', $photoTypes)
            ->with('currentYear', $currentYear)
            ->with('project', $project);
    }

    public function preview($id)
    {
        $project = Project::findOrFail($id);
        $photoTypes = ProjectPhotoType::orderBy('sort')->get();
        $photos = $project->getPhotosGroupedByType();

        return view('admin.project-preview')
            ->with('photoTypes', $photoTypes)
            ->with('project', $project)
            ->with('photos', $photos);
    }

    public function create(Request $request)
    {
        $projectService = ProjectService::create($request);
        if ($request->has('photo')) {
            foreach ($request->photo as $photoType=>$photoFiles) {
                foreach ($photoFiles as $photoFile) {
                    $projectService->addPhoto($photoFile, $photoType);
                }
            }
        }

        if ($request->has('action-publish')) {
            $projectService->publish();
        }

        return redirect()->route('admin-projects-item-preview', ['id' => $projectService->getProject()->id]);
    }

    public function edit(Request $request, $id) {
        $project = Project::findOrFail($id);
        $projectService = new ProjectService($project);
        if ($request->has('action-publish')) {
            $projectService->publish();
        } else if ($request->has('action-unpublish')) {
            $projectService->unpublish();
        }

        if ($request->page == 'edit') {
            $projectService->save($request);

            if ($request->has('favorite_photo')) {
                $projectService->setMainPhoto($request->favorite_photo);
            }

            if ($request->has('remove_photo')) {
                $projectService->removePhotos(array_keys($request->remove_photo));
            }

            if ($request->has('photo')) {
                foreach ($request->photo as $photoType=>$photoFiles) {
                    foreach ($photoFiles as $photoFile) {
                        $projectService->addPhoto($photoFile, $photoType);
                    }
                }
            }
        }

        if ($request->page == 'projects') {
            return back();
        }
        return redirect()->route('admin-projects-item-preview', ['id' => $id]);

    }

    public function delete(Request $request)
    {
        $project = Project::findOrFail($request->remove);
        $projectService = new ProjectService($project);
        $projectService->delete();

        return redirect()->route('admin-projects');
    }
}
