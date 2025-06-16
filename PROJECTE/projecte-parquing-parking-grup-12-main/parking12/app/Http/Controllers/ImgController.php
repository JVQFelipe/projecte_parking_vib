<?php

namespace App\Http\Controllers;

use App\Models\Img;
use App\Models\Parking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImgController extends Controller
{

    
    public function showGallery($parkingId)
    {
        $parking = Parking::findOrFail($parkingId); // Obtener el parking con el ID proporcionado
        $images = Img::where('parking_id', $parkingId)->get(); // Obtener las imágenes asociadas al parking
        return view('gallery', compact('parking', 'images')); // Pasar el parking y las imágenes a la vista
    }

    // Subir una nueva imagen para un parking
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Subir la imagen al sistema de archivos
        $path = $request->file('image')->store('images', 'public');


        // Crear un nuevo registro en la base de datos con el nombre y la URL de la imagen
        Img::create([
            'name' => basename($path),
            'url' => Storage::url($path),
            'parking_id' => $request->parking_id, // Asociar la imagen al parking correcto
        ]);

        return back()->with('success', 'Imatge pujades correctament');
    }
}
