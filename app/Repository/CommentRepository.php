<?php

namespace App\Repository;

use App\Models\CommentModel;

class CommentRepository
{
    private $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    public function createComment($post, $data)
    {
        $this->commentModel->create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'comment' => $data['comment']
        ]);
    }
}
