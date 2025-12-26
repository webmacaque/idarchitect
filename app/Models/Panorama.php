<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panorama extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function images()
    {
        return $this->hasMany(PanoramaImage::class)->orderBy('sort');
    }

    public function isTour(): bool
    {
        return $this->type === 'tour';
    }

    public function isPanorama(): bool
    {
        return $this->type === 'panorama';
    }

    public function getPreviewImage()
    {
        return $this->images()->first();
    }
}
