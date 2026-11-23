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
                        <i class="bi bi-plus-circle me-1"></i> New category
                    </div>
                    <div class="card-body">
                        <form action="{{ route('createCategory') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name"
                                       maxlength="50" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('categoryView') }}" class="btn btn-outline-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
