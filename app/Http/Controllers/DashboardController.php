<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $imagePaths = Storage::disk('public')->files('carousel-images');
        $carouselItems = array_chunk($imagePaths, 3);

        return view('admin.index', ['carouselItems' => $carouselItems]);
    }
}