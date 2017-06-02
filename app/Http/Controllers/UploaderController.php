<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Http\Requests;

use Storage;

class UploaderController extends Controller
{
	public function __construct()
    {
    	// 
    }

    public function upload(Request $request)
    {
        $fileName = $request->file('file')->getClientOriginalName();
    	
        Storage::disk('local')->put( 'videos/'.$fileName, File::get($request->file('file')));

        return response()->json( true );
    }
}
