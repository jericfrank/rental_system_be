<?php

namespace App\Repositories;

use Illuminate\Support\Facades\File;

use App\Videos;

use Storage, JWTAuth, Auth, Cloudder;

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

        Cloudder::uploadVideo($file->getRealPath(), null);

        $Cloudder = Cloudder::getResult();

        $video            = $this->getModel();
        $video->name      = $file->getClientOriginalName();
        $video->extention = $file->getClientOriginalExtension();
        $video->real_path = $file->getRealPath();
        $video->file_path = $Cloudder['secure_url'];
        $video->size      = $file->getSize();
        $video->mime_type = $file->getMimeType();
        $video->user_id   = Auth::user()->id;
        $video->save();

        return $video;
    }
}