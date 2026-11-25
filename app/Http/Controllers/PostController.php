<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPostRequest;
use App\Http\Requests\SavePostRequest;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\LikeModel;
use App\Models\PostModel;
use App\Repository\PostRepository;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use ImageUploadTrait;

    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function index()
    {
        Cache::forget('posts');
        $posts = Cache::remember('posts', 600,
            fn() => PostModel::GetAllPosts()->get());
        Cache::remember('categories', 600, fn() => CategoryModel::all());
        $likedPosts = LikeModel::GetLikedPosts()->pluck('post_id')->all();
        return view('welcome', ['posts' => $posts, 'likedPosts' => $likedPosts]);
    }

    public function getSearchData(Request $request)
    {
        if (!$request->anyFilled(['category_id', 'title', 'tag'])) {
            return redirect()->route('home');
        }

        $postData = $this->postRepository->getSearchQuery($request);
        $posts = $postData['posts'];
        $categoryId = $postData['categoryId'];

        $likedPosts = LikeModel::GetLikedPosts()->pluck('post_id')->all();
        return view('welcome', ['posts' => $posts, 'request' => $request, 'categoryId' => $categoryId, 'likedPosts' => $likedPosts]);
    }

    public function createPost(SavePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['post_image'] = $this->uploadImage($request->file('post_image'), 'post_images/');
        $post = PostModel::create($data);

        $tags = str_replace(' ', '', (string)$request->tags);
        $tags = array_unique(array_filter(explode(',', $tags)));

        $this->postRepository->createPost($tags, $post);

        return redirect()->route('home');
    }

    public function displayPost(PostModel $post)
    {
        $comments = CommentModel::where('post_id', $post->id)->get();
        return view('posts.displayPost', ['post' => $post, 'comments' => $comments]);
    }

    public function getEditPost(PostModel $post)
    {
        Gate::authorize('editPost', $post);
        $tags = implode(',', $post->tags->pluck('tag_name')->toArray());
        return view('posts.editPost', ['post' => $post, 'tags' => $tags]);
    }

    public function updatePost(PostModel $post, EditPostRequest $request)
    {
        Gate::authorize('editPost', $post);
        $data = $request->validated();
        if ($request->hasFile('post_image')) {
            Storage::disk('public')->delete('post_images/' . $post->post_image);
            $data['post_image'] = $this->uploadImage($request->file('post_image'), 'post_images/');
        }
        $post->update($data);

        $this->postRepository->updatePost($post, $request);

        return redirect()->route('home');
    }

    public function deletePost(PostModel $post)
    {
        Gate::authorize('editPost', $post);
        Storage::disk('public')->delete('post_images/' . $post->post_image);
        $this->postRepository->deletePost($post);
        return redirect()->route('home');
    }

    public function toggleLike(PostModel $post)
    {
        $this->postRepository->toggleLike($post);
        return redirect()->back();
    }
}
