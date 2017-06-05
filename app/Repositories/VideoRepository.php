<?php

namespace App\Repositories;

use Illuminate\Support\Facades\File;

use App\Videos;

use Storage, JWTAuth, Auth;

class VideoRepository
{
    public function getModel()
    {
        return new Videos();
    }

    public function get_all(){
        return $this->getModel()->all();
    }

    public function get_all_own(){
        return $this->getModel()->where( 'user_id', '=', Auth::user()->id )->get();
    }

    public function create( $request )
    {
        $file = $request->file('file');

        $video            = $this->getModel();
        $video->name      = $file->getClientOriginalName();
        $video->extention = $file->getClientOriginalExtension();
        $video->real_path = $file->getRealPath();
        $video->size      = $file->getSize();
        $video->mime_type = $file->getMimeType();
        $video->user_id   = Auth::user()->id;
        $video->save();

        $file_path     = 'public/videos/'.Auth::user()->id.'/'.$video->id;
        $file_contents = File::get( $file );

        Storage::disk('local')->put( $file_path, $file_contents );

        return $video;
    }
}