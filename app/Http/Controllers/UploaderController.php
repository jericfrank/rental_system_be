<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\VideoRequest;

use App\Repositories\VideoRepository;

class UploaderController extends Controller
{
    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function upload(VideoRequest $request)
    {
        $data = $this->videoRepository->create( $request );

        return response()->json( $data, 201 );
    }
}