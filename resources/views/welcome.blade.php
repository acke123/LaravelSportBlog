@extends('layout')

@section('title')
    Homepage
@endsection

@section('content')
    <main class="container my-5 flex-grow-1">
        <div class="mb-3">
            <a href="{{route('createPostView')}}" class="btn btn-info">Create new post <i class="bi bi-plus-lg"></i></a>
        </div>

        <form action="" method="GET" class="row g-3 align-items-end mb-4">
            <div class="col-12 col-md-3">
                <label for="category_id" class="form-label">Search by category</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="" selected>No category</option>
                    @foreach (\Illuminate\Support\Facades\Cache::get('categories') as $category)
                        <option value="{{$category->id}}"> {{$category->category_name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-3">
                <label for="title" class="form-label">Search by title</label>
                <input type="text" class="form-control" id="title" name="title" maxlength="50"
                       placeholder="Search by title">
            </div>

            <div class="col-12 col-md-3">
                <label for="tag" class="form-label">Search by a tag</label>
                <input type="text" class="form-control" id="tag" name="tag" maxlength="50"
                       placeholder="Search by a tag">
            </div>

            <div class="col-12 col-md-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
            <?php foreach ($posts as $post): ?>
            <div class="col">
                <div class="card post-card h-100">
                    <div class="card-header">
                        <a href="{{ route('displayPost', ['post' => $post->id]) }}"
                           class="text-decoration-none text-dark stretched-link">
                            {{$post->title}}
                        </a>
                        <p class="card-text">
                            {{ $post->category_name}}
                        </p>
                    </div>
                    <img src="storage/post_images/{{ $post->post_image}}"
                         alt="{{ $post->title}}"
                         loading="lazy">
                    <div class="card-body">
                        <p class="card-text">
                            {{ Str::limit(html_entity_decode(strip_tags($post->description)), 120) }}
                        </p>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            {{ $post->first_name . " " . $post->last_name}}
                        </p>
                    </div>

                    <div class="card-footer bg-white d-flex align-items-center gap-2">
                        <form action="" method="post" class="m-0">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button type="submit" class="btn btn-link text-danger p-0 position-relative z-2">
                                <i class="bi bi-heart-fill"></i>
                                <i class="bi bi-heart"></i>
                            </button>
                        </form>
                        <span>{{ $post->postLikes}}</span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
@endsection
