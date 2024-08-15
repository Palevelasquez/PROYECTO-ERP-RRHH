<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use File;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function construct(){
        $this->middleware(['auth']);
    }
    public function index(){
        $sliders = Slider::all();
        return view('web.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request) {
        $carpeta = 'storage/img/slider/';
        if (!file_exists($carpeta)) {
           File::makeDirectory($carpeta, 0755, true);
        }
        $titulo = $request->get('titulo');
        $descripcion = $request->get('descripcion');
        $image = $request->file('image');
        $image_name = $image->getClientOriginalName();
        $image = Image::make($image)
        ->save($carpeta.'/'.$image_name);
        $slider = Slider::create([
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'ruta_img' => $carpeta.$image_name,
        'nombre_img' => $image_name,
        'created_at' => Carbon::now(),
        ]);
        return back()->with('flash', 'Se agrego un nuevo Slider.');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
