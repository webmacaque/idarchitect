<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function publishedProjects()
    {
        return $this->hasMany(Project::class)
            ->published()
            ->selectRaw('projects.*, min(project_photo_types.sort) as photo_type_sort')
            ->join('project_photos', 'project_photos.project_id', '=', 'projects.id')
            ->join('project_photo_types', 'project_photos.project_photo_type_id', '=', 'project_photo_types.id')
            ->orderBy('photo_type_sort')
            ->orderByDesc('projects.year')
            ->groupBy('projects.id');
    }

    public function mainProjects()
    {
        return $this->publishedProjects()->take(6);
    }
}
