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

                    @if (Auth::user()->role != 'normal' || Auth::id() == $post->user_id)
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
            </div>
        </div>
    </main>
@endsection
