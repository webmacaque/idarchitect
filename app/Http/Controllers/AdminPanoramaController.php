<?php

namespace App\Http\Controllers;

use App\Models\Panorama;
use App\Models\PanoramaImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminPanoramaController extends Controller
{
    public function index()
    {
        $panoramas = Panorama::with('images')->orderByDesc('id')->get();
        
        return view('admin.panoramas')
            ->with('panoramas', $panoramas);
    }

    public function createTour()
    {
        return view('admin.panorama-tour-create');
    }

    public function createPanorama()
    {
        return view('admin.panorama-create');
    }

    public function storeTour(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:20480',
        ]);

        $panorama = Panorama::create([
            'name' => $request->name,
            'type' => 'tour',
        ]);

        $this->saveImages($panorama, $request->file('images'));

        return redirect()->route('admin-panoramas')->with('success', 'Тур успешно создан');
    }

    public function storePanorama(Request $request)
    {
        $request->validate([
            'images' => 'required|array|size:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:20480',
        ]);

        $panorama = Panorama::create([
            'name' => null,
            'type' => 'panorama',
        ]);

        $this->saveImages($panorama, $request->file('images'));

        return redirect()->route('admin-panoramas')->with('success', 'Панорама успешно создана');
    }

    public function editTour($id)
    {
        $panorama = Panorama::with('images')->where('type', 'tour')->findOrFail($id);
        
        return view('admin.panorama-tour-edit')
            ->with('panorama', $panorama);
    }

    public function updateTour(Request $request, $id)
    {
        $panorama = Panorama::where('type', 'tour')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:20480',
        ]);

        $panorama->update([
            'name' => $request->name,
        ]);

        if ($request->has('remove_images')) {
            $imagesToRemove = PanoramaImage::whereIn('id', $request->remove_images)
                ->where('panorama_id', $panorama->id)
                ->get();
            
            foreach ($imagesToRemove as $image) {
                $this->deleteImageFile($image->path);
                $image->delete();
            }
        }

        if ($request->hasFile('images')) {
            $this->saveImages($panorama, $request->file('images'));
        }

        return redirect()->route('admin-panoramas')->with('success', 'Тур успешно обновлен');
    }

    public function destroy(Request $request)
    {
        $panorama = Panorama::findOrFail($request->remove);
        
        foreach ($panorama->images as $image) {
            $this->deleteImageFile($image->path);
        }
        
        $panorama->delete();

        return redirect()->route('admin-panoramas')->with('success', 'Успешно удалено');
    }


    private function saveImages(Panorama $panorama, array $files)
    {
        $maxSort = $panorama->images()->max('sort') ?? 0;
        
        foreach ($files as $index => $file) {
            $filename = $file->getClientOriginalName();
            $uniqueName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('panoramas/' . $panorama->id, $uniqueName, 'public');
            
            PanoramaImage::create([
                'panorama_id' => $panorama->id,
                'path' => '/storage/' . $path,
                'filename' => $filename,
                'sort' => $maxSort + $index + 1,
            ]);
        }
    }
    
    private function deleteImageFile(string $path)
    {
        $storagePath = str_replace('/storage/', '', $path);
        if (Storage::disk('public')->exists($storagePath)) {
            Storage::disk('public')->delete($storagePath);
        }
    }
}
