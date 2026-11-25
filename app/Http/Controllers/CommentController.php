<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\CommentModel;
use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function createComment(createCommentRequest $request, PostModel $post)
    {
        $data = $request->validated();
        CommentModel::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'comment' => $data['comment']
        ]);
        return redirect()->back();
    }

    public function deleteComment(CommentModel $comment)
    {
        Gate::authorize('updateComment', $comment);
        $comment->delete();
        return redirect()->back();
    }
}
