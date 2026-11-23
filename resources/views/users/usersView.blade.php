@extends('layout')

@section('title')
    Users view
@endsection



@section('content')
    <main class="container my-5 flex-grow-1">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col">Email</th>
                    <th class="text-center" scope="col">Role</th>
                    <th class="text-center" scope="col" colspan="2">Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="text-center"><?= $user->name ?></td>
                        <td class="text-center"><?= $user->email ?></td>
                        <td class="text-center"><?= $user->role ?></td>

                        <td class="text-center"><a href="{{ route('editCategoryView', ['category' => $user->id]) }}" type="button"
                                                   class="btn btn-primary">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('deleteCategory', $user) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form></td></tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
