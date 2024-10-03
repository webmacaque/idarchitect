<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProjectService
{
    private Project $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    public function publish() {
        $this->project->is_published = true;
        $this->project->save();
    }

    public function unpublish() {
        $this->project->is_published = false;
        $this->project->save();
    }

    public function save(Request $request) {
        $this->project->name = Str::trim($request->name);
        $this->project->slug = Str::slug("{$this->project->name} {$request->year}");
        $this->project->project_type_id = $request->type;
        $this->project->short_description = Str::trim($request->short_description);
        $this->project->description = Str::trim($request->description);
        $this->project->year = $request->year;
        $this->project->home_page = $request->home_page;
        $this->project->save();
    }

    public static function create(Request $request) : ProjectService
    {
        $project = new Project();
        $project->name = Str::trim($request->name);
        $project->slug = Str::slug("{$project->name} {$request->year}");
        $project->project_type_id = $request->type;
        $project->short_description = Str::trim($request->short_description);
        $project->description = Str::trim($request->description);
        $project->year = $request->year;
        $project->home_page = $request->home_page;
        $project->save();

        return new self($project);
    }

    public function delete()
    {
        $projectId = $this->project->id;
        $photoIds = ProjectPhoto::where('project_id', $projectId)
            ->get()
            ->map(function (ProjectPhoto $photo) {
                return $photo->id;
            });
        $this->removePhotos($photoIds);
        $this->project?->delete();
    }

    public function setMainPhoto($photoId)
    {
        DB::update('update project_photos set main=false where project_id=?', [$this->project->id]);
        $favoritePhoto = ProjectPhoto::find($photoId);
        $favoritePhoto->main = true;
        $favoritePhoto->save();
    }

    public function removePhotos($photoIds)
    {
        foreach ($photoIds as $photoId) {
            $photo = ProjectPhoto::find($photoId);
            $photoPath = public_path($photo->path);
            if (File::exists($photoPath)) {
                File::delete($photoPath);
            }
        }
        ProjectPhoto::destroy($photoIds);
    }

    public function addPhoto($photoFile, $photoType) {
        $filePath = $photoFile->store('project_images', 'public');
        $this->createProjectPhoto($photoFile, $filePath, $photoType);
    }


    private function createProjectPhoto($photoFile, $photoFilePath, $photoType)
    {
        $filename = $photoFile->getClientOriginalName();
        $projectPhoto = new ProjectPhoto();
        $projectPhoto->path = Storage::url($photoFilePath);
        $projectPhoto->filename = $filename;
        $projectPhoto->project_photo_type_id = $photoType;
        $projectPhoto->project_id = $this->project->id;
        $projectPhoto->save();
    }
}
