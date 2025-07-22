<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::with('categories')->where('status', 'published');

        if ($request->has('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $video = $query->latest()->paginate(10);
        return response()->json($video);
    }

    public function show($slug)
    {
        $video= Video::with('categories')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        return response()->json($video);
    }

     public function view($id)
    {
        $video= Video::with('categories')->where('id', $id)->where('status', 'published')->firstOrFail();
        return response()->json($video);
    }
}
