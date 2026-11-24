@extends('layout')

@section('title')
    About Us
@endsection

@section('content')
    <div class="container my-5">
        <h1 class="mb-3">About Us</h1>
        <p class="lead">
            SportBlog is a sports platform built with Laravel where people share posts about their
            favorite sports and react to what others write.
        </p>

        <h2 class="h4 mt-5">What can you do here?</h2>
        <ul>
            <li>Register and log in to your account.</li>
            <li>Create posts and choose a category (sport) for each one.</li>
            <li>Add tags to your posts so others can find them.</li>
            <li>Search posts by tag, sport or title.</li>
            <li>Comment on posts and read what others think.</li>
            <li>Delete your own comments.</li>
            <li>Like posts. The number of likes is shown on every post.</li>
            <li>Edit your own profile.</li>
        </ul>

        <h2 class="h4 mt-5">User roles</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h5 card-title">Admin</h3>
                        <p class="card-text mb-0">
                            Sees all users, changes their roles and data, and can create, edit and delete any post.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h5 card-title">Editor</h3>
                        <p class="card-text mb-0">
                            Can create posts, edit and delete posts. Can edit only their own profile.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h5 card-title">User</h3>
                        <p class="card-text mb-0">
                            Can create posts, like posts and search. Can edit only their own profile.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <p class="mt-4 text-muted">
            The first person who registers becomes the Admin. Everyone else starts as a User,
            and the Admin can change their role later.
        </p>
    </div>
@endsection
