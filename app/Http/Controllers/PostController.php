<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePostRequest;
use App\Models\CategoryModel;
use App\Models\PostModel;
use App\Models\TagModel;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $posts = Cache::remember('posts', 600,
            fn () => PostModel::all());
        $categories = Cache::remember('categories', 600, fn () => CategoryModel::all());
        return view('welcome', ['posts' => $posts, 'categories' => $categories]);
    }

    public function createPost(SavePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['post_image'] = $this->uploadImage($request->file('post_image'), 'post_images/');
        $post = PostModel::create($data);

        $tags = str_replace(' ', '', (string)$request->tags);
        $tags = array_unique(array_filter(explode(',', $tags)));

        foreach ($tags as $tag) {
            TagModel::create([
                'post_id' => $post->id,
                'tag_name' => $tag
            ]);
        }
        return redirect()->route('home');
    }
}
