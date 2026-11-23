@extends('layout')

@section('title')
    New category
@endsection

@section('content')
    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-header bg-white fw-semibold">
                        <i class="bi bi-plus-circle me-1"></i> Edit category
                    </div>
                    <div class="card-body">
                        <form action="{{ route('editCategory', $category) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category name</label>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <input type="text" class="form-control" id="category_name" name="category_name"
                                       maxlength="50" value="{{ $category->category_name }}" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('categoryView') }}" class="btn btn-outline-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
