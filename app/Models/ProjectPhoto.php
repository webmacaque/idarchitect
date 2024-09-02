<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectPhoto extends Model
{
    use HasFactory;

    /**
     * Проект, которому принадлежит фото
     */
    public function project()
    {
        $this->belongsTo(Project::class);
    }

    public function projectPhotoType()
    {
        $this->belongsTo(ProjectPhotoType::class);
    }
}
