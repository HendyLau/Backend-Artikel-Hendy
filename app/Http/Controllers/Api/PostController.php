<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('categories')->where('status', 'published');

        if ($request->has('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $posts = $query->latest()->paginate(10);
        return response()->json($posts);
    }

    public function show($slug)
    {
        $post = Post::with('categories')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        return response()->json($post);
    }

    public function view($id)
    {
        $post = Post::with('categories')->where('id', $id)->where('status', 'published')->firstOrFail();
        return response()->json($post);
    }
}
