@extends('layout')

@section('title')
    About Us
@endsection

@section('content')
    <div class="container my-5">
        <div class="p-4 p-md-5 mb-5 bg-light rounded-3 border">
            <h1 class="display-6 fw-bold mb-3">About SportBlog</h1>
            <p class="lead mb-2">
                SportBlog is a sports blogging platform built with <strong>Laravel 12</strong> where people share
                posts about their favorite sports, add tags, search, like and comment on what others write.
            </p>
            <p class="text-muted mb-0">
                The project was made as a certificate project and shows practical use of Laravel features:
                authentication, roles, middleware, policies, the repository pattern, observers, Redis caching,
                form request validation, Eloquent relationships and scopes, traits and image processing.
            </p>
        </div>

        <h2 class="h4 mb-3">What can you do here?</h2>
        <div class="row g-3 mb-5">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h6 card-title"><i class="bi bi-person-check"></i> Account</h3>
                        <ul class="small mb-0">
                            <li>Register and log in (Laravel Breeze).</li>
                            <li>Reset a forgotten password.</li>
                            <li>Edit your name, email and password.</li>
                            <li>Delete your own account.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h6 card-title"><i class="bi bi-file-earmark-richtext"></i> Posts</h3>
                        <ul class="small mb-0">
                            <li>Create a post with title, description and image.</li>
                            <li>Choose a category (sport) for every post.</li>
                            <li>Images are automatically converted to <strong>WebP</strong>.</li>
                            <li>Edit or delete posts (depending on your role).</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h6 card-title"><i class="bi bi-tags"></i> Tags &amp; search</h3>
                        <ul class="small mb-0">
                            <li>Add comma-separated tags to posts (duplicates are removed).</li>
                            <li>Search posts by <strong>sport</strong>, <strong>title</strong> or <strong>tag</strong>.</li>
                            <li>Filters can be combined.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h6 card-title"><i class="bi bi-heart"></i> Likes</h3>
                        <ul class="small mb-0">
                            <li>Like or unlike any post with one click.</li>
                            <li>Number of likes is shown on every post.</li>
                            <li>Posts you already liked are highlighted.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h6 card-title"><i class="bi bi-chat-dots"></i> Comments</h3>
                        <ul class="small mb-0">
                            <li>Comment on any post (up to 1000 characters).</li>
                            <li>Number of comments is shown on every post.</li>
                            <li>Delete your own comments.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h6 card-title"><i class="bi bi-shield-lock"></i> Administration</h3>
                        <ul class="small mb-0">
                            <li>Manage categories (sports): create, edit, delete.</li>
                            <li>Manage users: change name and role, delete users.</li>
                            <li>Available only to the Admin.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="h4 mb-3"><i class="bi bi-people"></i> User roles</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card h-100 border-danger">
                    <div class="card-header bg-danger text-white fw-semibold">
                        <i class="bi bi-shield-fill-check"></i> Admin
                    </div>
                    <div class="card-body">
                        <p class="card-text mb-0">
                            Has full control. Sees all users, changes their name and role and deletes them.
                            Manages categories (sports). Can edit and delete any post and any comment.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-primary">
                    <div class="card-header bg-primary text-white fw-semibold">
                        <i class="bi bi-pencil-square"></i> Editor
                    </div>
                    <div class="card-body">
                        <p class="card-text mb-0">
                            Moderates content. Can create posts and edit or delete <strong>any</strong> post,
                            and delete <strong>any</strong> comment. Cannot manage users or categories.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-secondary">
                    <div class="card-header bg-secondary text-white fw-semibold">
                        <i class="bi bi-person"></i> Normal user
                    </div>
                    <div class="card-body">
                        <p class="card-text mb-0">
                            Can create posts, like, comment and search. Can edit and delete only
                            <strong>their own</strong> posts and comments, and edit only their own profile.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <p class="mt-3 text-muted small">
            Every new registered user gets the <strong>Normal</strong> role by default. The first Admin account
            is created by the database seeder, and the Admin can later change anyone's role.
        </p>

        <h2 class="h4 mt-5 mb-3"><i class="bi bi-table"></i> Permissions overview</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                <tr>
                    <th class="text-start">Action</th>
                    <th>Normal</th>
                    <th>Editor</th>
                    <th>Admin</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $yes = '<i class="bi bi-check-circle-fill text-success"></i>';
                    $no = '<i class="bi bi-x-circle-fill text-danger"></i>';
                    $own = '<span class="badge text-bg-warning">own only</span>';
                    $permissions = [
                        ['View posts and search', $yes, $yes, $yes],
                        ['Create posts', $yes, $yes, $yes],
                        ['Like / unlike posts', $yes, $yes, $yes],
                        ['Write comments', $yes, $yes, $yes],
                        ['Edit / delete posts', $own, $yes, $yes],
                        ['Delete comments', $own, $yes, $yes],
                        ['Edit profile / delete account', $own, $own, $own],
                        ['Manage categories (sports)', $no, $no, $yes],
                        ['View users, change roles, delete users', $no, $no, $yes],
                    ];
                @endphp
                @foreach ($permissions as $row)
                    <tr>
                        <td class="text-start">{{ $row[0] }}</td>
                        <td>{!! $row[1] !!}</td>
                        <td>{!! $row[2] !!}</td>
                        <td>{!! $row[3] !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <h2 class="h4 mt-5 mb-3"><i class="bi bi-gear-wide-connected"></i> How it works under the hood</h2>
        <div class="mb-3">
            <span class="badge text-bg-dark">Laravel 12</span>
            <span class="badge text-bg-dark">PHP 8.2</span>
            <span class="badge text-bg-dark">MySQL</span>
            <span class="badge text-bg-danger">Redis (Predis)</span>
            <span class="badge text-bg-dark">Laravel Breeze</span>
            <span class="badge text-bg-dark">Intervention Image</span>
            <span class="badge text-bg-primary">Bootstrap 5</span>
        </div>

        <div class="accordion" id="techAccordion">

            {{-- Middleware --}}
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#techMiddleware">
                        <i class="bi bi-funnel me-2"></i> Middleware
                    </button>
                </h3>
                <div id="techMiddleware" class="accordion-collapse collapse show" data-bs-parent="#techAccordion">
                    <div class="accordion-body">
                        <ul class="mb-0">
                            <li><code>auth</code> &ndash; every page (posts, comments, likes, profile, this page) requires login.</li>
                            <li><code>AdminCheckMiddleware</code> &ndash; custom middleware that protects all category and
                                user management routes; anyone who is not Admin is redirected.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#techPolicies">
                        <i class="bi bi-shield-check me-2"></i> Policies (authorization)
                    </button>
                </h3>
                <div id="techPolicies" class="accordion-collapse collapse" data-bs-parent="#techAccordion">
                    <div class="accordion-body">
                        <p>Controllers check permissions with <code>Gate::authorize()</code>, and the rules live in policy classes:</p>
                        <ul class="mb-0">
                            <li><code>PostModelPolicy::editPost</code> &ndash; editing/deleting a post is allowed if the user is
                                not Normal, <em>or</em> is the author of the post.</li>
                            <li><code>CommentModelPolicy::updateComment</code> &ndash; deleting a comment is allowed if the user is
                                not Normal, <em>or</em> wrote the comment.</li>
                            <li><code>CategoryModelPolicy::updateCategory</code> &ndash; only Admin can manage categories.</li>
                            <li><code>UserPolicy::updateUser</code> &ndash; only Admin can view, edit and delete users.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#techRepository">
                        <i class="bi bi-box-seam me-2"></i> Repository pattern
                    </button>
                </h3>
                <div id="techRepository" class="accordion-collapse collapse" data-bs-parent="#techAccordion">
                    <div class="accordion-body">
                        <p>Database logic is moved out of controllers into repositories, so controllers stay short and clean:</p>
                        <ul class="mb-0">
                            <li><code>PostRepository</code> &ndash; search query (category, title, tag with a join on tags),
                                saving and updating tags, deleting a post together with its tags, and toggling likes.</li>
                            <li><code>CommentRepository</code> &ndash; creating comments for a post on behalf of the logged-in user.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#techRedis">
                        <i class="bi bi-lightning-charge me-2"></i> Redis cache
                    </button>
                </h3>
                <div id="techRedis" class="accordion-collapse collapse" data-bs-parent="#techAccordion">
                    <div class="accordion-body">
                        <p>
                            The cache store is <strong>Redis</strong> (<code>CACHE_STORE=redis</code>, client <code>predis</code>).
                            Frequently read data is stored with <code>Cache::remember()</code> for 10 minutes (600 s),
                            so the database is not queried on every request:
                        </p>
                        <ul>
                            <li><code>posts</code> &ndash; all posts with like and comment counts (home page).</li>
                            <li><code>categories</code> &ndash; list of sports (search filter and category management).</li>
                            <li><code>users</code> &ndash; list of users in the admin panel.</li>
                        </ul>
                        <p class="mb-0">When data changes, observers delete the matching key so the next request loads fresh data.</p>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#techObservers">
                        <i class="bi bi-eye me-2"></i> Observers
                    </button>
                </h3>
                <div id="techObservers" class="accordion-collapse collapse" data-bs-parent="#techAccordion">
                    <div class="accordion-body">
                        <p>Observers are registered in <code>AppServiceProvider</code> and listen for model events
                            (<em>created</em>, <em>updated</em>, <em>deleted</em>) to keep the Redis cache in sync:</p>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="table-light">
                                <tr><th>Observer</th><th>Model</th><th>Clears cache key</th></tr>
                                </thead>
                                <tbody>
                                <tr><td><code>PostObserver</code></td><td>PostModel</td><td><code>posts</code></td></tr>
                                <tr><td><code>LikeObserver</code></td><td>LikeModel</td><td><code>posts</code> (like counts change)</td></tr>
                                <tr><td><code>CategoryObserver</code></td><td>CategoryModel</td><td><code>categories</code></td></tr>
                                <tr><td><code>UserObserver</code></td><td>User</td><td><code>users</code></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#techValidation">
                        <i class="bi bi-check2-square me-2"></i> Validation (Form Requests)
                    </button>
                </h3>
                <div id="techValidation" class="accordion-collapse collapse" data-bs-parent="#techAccordion">
                    <div class="accordion-body">
                        <ul class="mb-0">
                            <li><code>SavePostRequest</code> &ndash; title (max 50), description (max 1000), existing category,
                                required image (jpeg, png, jpg, gif, max 5 MB).</li>
                            <li><code>EditPostRequest</code> &ndash; same rules, but the image is optional.</li>
                            <li><code>CreateCommentRequest</code> &ndash; comment is required, max 1000 characters.</li>
                            <li><code>ProfileUpdateRequest</code> &ndash; name and unique email.</li>
                            <li>Categories must have a unique name (max 50); user role must be <em>admin</em>, <em>editor</em> or <em>normal</em>.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#techEloquent">
                        <i class="bi bi-diagram-3 me-2"></i> Database &amp; Eloquent
                    </button>
                </h3>
                <div id="techEloquent" class="accordion-collapse collapse" data-bs-parent="#techAccordion">
                    <div class="accordion-body">
                        <p>Tables: <code>users</code>, <code>categories</code>, <code>posts</code>, <code>tags</code>,
                            <code>likes</code>, <code>comments</code> (created with migrations).</p>
                        <ul class="mb-0">
                            <li><strong>Relationships:</strong> a post <code>hasMany</code> tags, likes and comments;
                                a like and a comment <code>belongsTo</code> a user.</li>
                            <li><strong>Local scopes:</strong> <code>GetAllPosts</code> loads posts with
                                <code>withCount('likes')</code> and <code>withCount('comments')</code>;
                                <code>GetLikedPosts</code> returns the likes of the logged-in user.</li>
                            <li><strong>Constants:</strong> roles are defined as <code>User::ADMIN</code>,
                                <code>User::EDITOR</code>, <code>User::NORMAL</code> instead of plain strings.</li>
                            <li><strong>Seeders:</strong> <code>FirstUser</code> creates the Admin, <code>UserSeeder</code>
                                creates test users with Faker and random Editor/Normal roles.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#techImages">
                        <i class="bi bi-image me-2"></i> Image upload (Trait)
                    </button>
                </h3>
                <div id="techImages" class="accordion-collapse collapse" data-bs-parent="#techAccordion">
                    <div class="accordion-body mb-0">
                        <code>ImageUploadTrait</code> uses <strong>Intervention Image</strong> (GD driver) to convert
                        every uploaded image to <strong>WebP</strong> (quality 90) with a unique name and saves it on the
                        <code>public</code> disk. When a post image is replaced or a post is deleted, the old file is
                        removed from storage.
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
