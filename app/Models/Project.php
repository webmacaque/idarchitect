<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * Только опубликованные проекты
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->selectRaw('projects.*, min(project_photo_types.sort) as photo_type_sort')
            ->join('project_photos', 'project_photos.project_id', '=', 'projects.id')
            ->join('project_photo_types', 'project_photos.project_photo_type_id', '=', 'project_photo_types.id')
            ->orderBy('photo_type_sort')
            ->orderByDesc('projects.year')
            ->groupBy('projects.id');
    }

    /**
     * Фото проекта
     */
    public function projectPhotos()
    {
        return $this->hasMany(ProjectPhoto::class);
    }

    public function photosByType($photoTypeSlug)
    {
        return $this->hasMany(ProjectPhoto::class)
            ->join('project_photo_types', 'project_photos.project_photo_type_id', '=', 'project_photo_types.id')
            ->where('project_photo_types.slug', $photoTypeSlug);
    }

    /**
     * Главное фото проекта
     */
    public function mainPhoto()
    {
        return $this->hasOne(ProjectPhoto::class)
            ->join('project_photo_types', 'project_photos.project_photo_type_id', '=', 'project_photo_types.id')
            ->orderByDesc('main')
            ->orderBy('project_photo_types.sort')
            ->orderBy('project_photos.id')
            ->take(1);
    }

    /**
     * Тип проекта
     */
    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }

    /**
     * Проекты для публикации на главной странице в верхней части
     */
    public function scopeMainTop($query)
    {
        return $query->selectRaw('projects.*, min(project_photo_types.sort) as photo_type_sort')
            ->join('project_photos', 'project_photos.project_id', '=', 'projects.id')
            ->join('project_photo_types', 'project_photos.project_photo_type_id', '=', 'project_photo_types.id')
            ->where('projects.is_published', true)
            ->where('home_page', true)
            ->orderBy('photo_type_sort')
            ->orderBy('projects.year', 'desc')
            ->groupBy('projects.id')
            ->take(3);
    }
}
