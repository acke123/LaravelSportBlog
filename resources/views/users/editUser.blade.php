@php use App\Models\User; @endphp
@extends('layout')

@section('title')
    Edit user
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
                        <form action="{{ route('editUser', $user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <input type="text" class="form-control" id="name" name="name"
                                       maxlength="50" value="{{ $user->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Choose role</label>
                                <select name='role' class="form-select" aria-label="Choose role">
                                    @foreach(User::ROLES as $role)
                                        <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : ''}}>{{ ucfirst($role) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('usersView') }}" class="btn btn-outline-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
