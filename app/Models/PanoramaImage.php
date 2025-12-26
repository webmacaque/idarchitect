<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanoramaImage extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'filename', 'sort', 'panorama_id'];

    public function panorama()
    {
        return $this->belongsTo(Panorama::class);
    }
}
