<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Repository\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    private $commentRepository;
    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
    }

    public function createComment(createCommentRequest $request, PostModel $post)
    {
        $data = $request->validated();
        $this->commentRepository->createComment($post, $data);
        return redirect()->back();
    }

    public function deleteComment(CommentModel $comment)
    {
        Gate::authorize('updateComment', $comment);
        $comment->delete();
        return redirect()->back();
    }
}
