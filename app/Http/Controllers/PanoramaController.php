<?php

namespace App\Http\Controllers;

use App\Models\Panorama;
use Illuminate\Http\Request;

class PanoramaController extends Controller
{
    public function tour($id)
    {
        $panorama = Panorama::with('images')->where('type', 'tour')->findOrFail($id);
        
        return view('panorama-tour')
            ->with('panorama', $panorama);
    }

    public function panorama($id)
    {
        $panorama = Panorama::with('images')->where('type', 'panorama')->findOrFail($id);
        
        return view('panorama-single')
            ->with('panorama', $panorama);
    }
}
