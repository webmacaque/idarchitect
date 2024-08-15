<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    use HasFactory;

    /**
     * Все проекты типа
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Опубликованные проекты типа
     */
    public function publishedProjects()
    {
        return $this->hasMany(Project::class)
            ->published()
            ->ordered();
    }

    /**
     * Проекты типа, для публикации на главной
     */
    public function mainProjects()
    {
        return $this->publishedProjects()->take(6);
    }
}
