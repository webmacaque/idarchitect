<?php

namespace App\Http\Controllers;

use App\Models\Panorama;
use Illuminate\Http\Request;

class PanoramaController extends Controller
{
    public function tour($hash)
    {
        $panorama = Panorama::with('images')
            ->where('type', 'tour')
            ->where('public_hash', $hash)
            ->firstOrFail();
        
        return view('panorama-tour')
            ->with('panorama', $panorama);
    }

    public function panorama($hash)
    {
        $panorama = Panorama::with('images')
            ->where('type', 'panorama')
            ->where('public_hash', $hash)
            ->firstOrFail();
        
        return view('panorama-single')
            ->with('panorama', $panorama);
    }
}
