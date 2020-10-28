<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductImage;


use Storage;
use Str;


class ProductImageController extends Controller
{
    public function editImage(Request $request, $id)
    {
    	$imagen = ProductImage::find($id);
    	$deleted = Storage::disk('public')->delete($imagen->image);

        //--------- ACTUALIZAR IMAGEN SECUNDARIA -------
    	if(isset($deleted) || $imagen->image == null)
    	{
    	    $path = $request->file('new_image')->store('public');

    	    $file = Str::replaceFirst('public/', '',$path);

    	    $imagen->update([
	            'image' => $file,
	        ]);

	        return back()->with('message', 'Imagen secundaria actualizada con éxito');
    	}

    }
}
