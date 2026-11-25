<?php

namespace App\Repository;

use App\Models\LikeModel;
use App\Models\PostModel;
use App\Models\TagModel;

class PostRepository
{
    private $postModel;
    private $tagModel;
    private $likeModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->tagModel = new TagModel();
        $this->likeModel = new LikeModel();
    }

    public function getSearchQuery($request)
    {
        $posts = $this->postModel->GetAllPosts()
            ->leftJoin('tags', 'posts.id', '=', 'tags.post_id')
            ->select('posts.*');

        $categoryId = 0;
        if (!is_null($request->category_id)) {
            $posts->where('posts.category_id', $request->category_id);
            $categoryId = (int)$request->category_id;
        }

        if (!is_null($request->title)) {
            $posts->where('posts.title', 'like', "%$request->title%");
        }

        if (!is_null($request->tag)) {
            $posts->where('tags.tag_name', 'like', "%$request->tag%");
        }
        $posts->distinct()->get();

        return [
            'posts' => $posts,
            'categoryId' => $categoryId
        ];
    }

    public function createPost($tags, $post)
    {
        foreach ($tags as $tag) {
            $this->tagModel->create([
                'post_id' => $post->id,
                'tag_name' => $tag
            ]);
        }
    }

    public function updatePost($post, $request)
    {
        $this->tagModel->where('post_id', $post->id)->delete();
        $tags = str_replace(' ', '', (string)$request->tags);
        $tags = array_unique(array_filter(explode(',', $tags)));

        foreach ($tags as $tag) {
            $this->tagModel->create([
                'post_id' => $post->id,
                'tag_name' => $tag
            ]);
        }
    }

    public function deletePost($post)
    {
        $this->tagModel->where('post_id', $post->id)->delete();
        $post->delete();
    }

    public function toggleLike($post)
    {
        $isLiked = $this->likeModel->GetLikedPosts()->where('post_id', $post->id)->first();
        if ($isLiked) {
            $isLiked->delete();
        } else {
            $this->likeModel->create([
                'user_id' => auth()->user()->id,
                'post_id' => $post->id
            ]);
        }
    }
}
