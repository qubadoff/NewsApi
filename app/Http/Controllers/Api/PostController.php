<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function posts(): JsonResponse
    {
        $posts = Post::paginate(15);

        return response()->json([
            'data' => $posts,
            'cover_image_server_url' => env('APP_URL') . '/storage/'
        ], 200);
    }

    public function categories(): JsonResponse
    {
        $category = Category::all();

        return response()->json([
            'data' => $category
        ], 200);
    }

    public function searchPost(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|max:300'
        ],[
            'title.required' => 'Title is required !',
            'title.max' => 'Max 300 symbol !'
        ]);

        $post = Post::query()
        ->when(
            $request->q,
            function (Builder $builder) use ($request) {
                $builder->where('title', 'like', "%{$request->q}%");
            }
        )->paginate(15);

        return response()->json([
            'data' => $post
        ], 200);
    }

    public function searchCategory(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|max:100'
        ],[
            'title.required' => 'Title is Required !',
            'title.max' => 'Max 100 symbol !'
        ]);

        $cat = Category::query()
            ->when(
                $request->q,
                function (Builder $builder) use ($request) {
                    $builder->where('title', 'like', "%$request->q");
                }
            )->paginate(15);

        return response()->json([
            'data' => $cat
        ], 200);
    }
}
