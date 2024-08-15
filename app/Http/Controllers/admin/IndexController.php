<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class indexController extends Controller
{
    
    public function __construnct(){
        $this->middleware(['auth']);
    }
    public function index()
    {
        $imagePaths = Storage::disk('public')->files('carousel-images');
        $carouselItems = array_chunk($imagePaths, 3);

        return view('web.admin.index', ['carouselItems' => $carouselItems]);
    }
}