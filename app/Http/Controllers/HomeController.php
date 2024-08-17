<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index(){
         
        $theme = session()->get('theme', 'light'); // Obtén el tema de la sesión o usa 'light' como valor por defecto

        //$sliders = Slider::all();
         //return view('welcome',compact('sliders'));   
         return view('web.admin.index', compact('theme'));;
    }
}
