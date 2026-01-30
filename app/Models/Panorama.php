<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Panorama extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'public_hash'];

    protected static function booted(): void
    {
        static::creating(function (self $panorama) {
            if (empty($panorama->public_hash)) {
                $panorama->public_hash = self::generateUniqueHash();
            }
        });
    }

    public static function generateUniqueHash(): string
    {
        do {
            $hash = Str::random(16);
        } while (self::where('public_hash', $hash)->exists());

        return $hash;
    }

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
