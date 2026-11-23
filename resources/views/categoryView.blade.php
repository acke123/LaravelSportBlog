@extends('layout')

@section('title')
    Homepage
@endsection



@section('content')
    <main class="container my-5 flex-grow-1">
        <div class="mb-3">
            <a href="" class="btn btn-info">Create Category<i class="bi bi-plus-lg"></i></a>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col" colspan="2">Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="text-center"><?= $category['name'] ?></td>
                    </tr>
                    <td class="text-center"><a href="" type="button"
                                               class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a></td>
                    <td class="text-center"><a href="" type="button" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Delete
                        </a></td>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
