@php use App\Models\User; @endphp
@extends('layout')

@section('title')
    Post detail
@endsection

@section('content')
    <main class="container my-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card post-card">
                    <img src="../storage/post_images/{{ $post->post_image }}"
                         alt="{{ $post->title }}"
                         style="height: 400px;">
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <p class="text-muted">
                            {{ $post->category_name }} ·
                            {{ $post->first_name . ' ' . $post->last_name }}
                        </p>
                        <div style="white-space: pre-line;">{!! $post->description !!}</div>

                        <p style="white-space: pre-line;">{{$post->tags ? '' : "Tags: " . $post->tags }}</p>
                    </div>

                    @if (Auth::user()->role != User::NORMAL || Auth::id() == $post->user_id)
                        <div class="card-footer bg-white d-flex gap-2">
                            <a href="{{ route('displayEditPost', ['post' => $post]) }}"
                               class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{route('deletePost', ['post' => $post])}}" method="POST"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
                <a href="{{route('home')}}" class="btn btn-outline-secondary mt-3">Back</a>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Leave a comment</h5>
                        <form action="{{route('createComment', ['post' => $post])}}" method="POST">
                            @csrf
                            <div class="mb-3">
                <textarea class="form-control" name="comment" rows="3" maxlength="1000"
                          placeholder="Write a comment..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Post comment
                            </button>
                        </form>
                    </div>
                </div>


                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Comments</h5>
                        @foreach($comments as $comment)
                            <div class="border-bottom pb-2 mb-2">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong>{{ $comment->user->name }}:</strong>
                                        <small class="text-muted ms-2">{{ $comment->updated_at }}</small>
                                    </div>

                                    @if(auth()->id() == $comment->user_id || auth()->user()->role != User::NORMAL)
                                        <form action="{{route('deleteComment', ['comment' => $comment->id])}}"
                                              method="POST"
                                              class="m-0" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0"
                                                    title="Delete comment">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <p class="mb-0">{{ $comment->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
