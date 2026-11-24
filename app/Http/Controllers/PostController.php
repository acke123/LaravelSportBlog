<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPostRequest;
use App\Http\Requests\SavePostRequest;
use App\Models\CategoryModel;
use App\Models\PostModel;
use App\Models\TagModel;
use App\Traits\ImageUploadTrait;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $posts = Cache::remember('posts', 600,
            fn() => PostModel::all());
        $categories = Cache::remember('categories', 600, fn() => CategoryModel::all());
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

    public function displayPost(PostModel $post)
    {
        return view('posts.displayPost', ['post' => $post]);
    }

    public function getEditPost(PostModel $post)
    {
        $tags = implode(',', $post->tags->pluck('tag_name')->toArray());
        return view('posts.editPost', ['post' => $post, 'tags' => $tags]);
    }

    public function updatePost(PostModel $post, EditPostRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('post_image')) {
            Storage::disk('public')->delete('post_images/' .$post->post_image);
            $data['post_image'] = $this->uploadImage($request->file('post_image'), 'post_images/');
        }
        $post->update($data);

        TagModel::where('post_id', $post->id)->delete();
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

    public function deletePost(PostModel $post)
    {
        Storage::disk('public')->delete('post_images/' .$post->post_image);
        TagModel::where('post_id', $post->id)->delete();
        $post->delete();
        return redirect()->route('home');
    }
}
