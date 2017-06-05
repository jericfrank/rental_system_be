<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\VideoRepository;

class VideoController extends Controller
{
    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function index()
    {
        $data = $this->videoRepository->get_all_own();

        return response()->json( $data );
    }
}
