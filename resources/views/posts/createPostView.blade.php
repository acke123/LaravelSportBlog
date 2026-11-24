@php use App\Models\CategoryModel; @endphp
@extends('layout')

@section('title')
    Create post
@endsection

@section('content')
    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-header bg-white fw-semibold">
                        <i class="bi bi-plus-circle me-1"></i> New post
                    </div>
                    <div class="card-body">
                        <form action="{{ route('createPost') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       maxlength="50" value="{{ old('title') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="" selected disabled>Choose category</option>
                                    @foreach (CategoryModel::all() as $category)
                                        <option value="{{$category->id}}"> {{$category->category_name}}
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                          rows="6" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <input type="text" class="form-control" id="tags" name="tags"
                                       placeholder="nba, euroleague, final-four" value="{{ old('tags') }}">
                                <div class="form-text">
                                    Separate tags with a comma. Allowed: letters, numbers, _ and -.
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="post_image" class="form-label">Image</label>
                                <input class="form-control" type="file" id="post_image" name="post_image"
                                       accept="image/*" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
