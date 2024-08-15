<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'carousel' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $name);

        Image::create([
            'carousel' => $request->carousel,
            'path' => $name,
        ]);

        return redirect()->back()->with('success', 'Imagen subida con éxito');
    }
}