# SportBlog

SportBlog is a sports blogging platform built with **Laravel 12**. Users share posts about their favorite sports, add tags, search, like and comment on posts. Access is controlled by three roles: **Admin**, **Editor** and **Normal user**.

The project was made as a certificate project and shows practical use of Laravel features: authentication, roles, middleware, policies, the repository pattern, observers, Redis caching, form request validation, Eloquent relationships and scopes, traits and image processing.

---

## Features

### Account
- Register, log in and log out (Laravel Breeze)
- Reset a forgotten password
- Edit your name, email and password
- Delete your own account

### Posts
- Create a post with a title, description, image and category (sport)
- Uploaded images are automatically converted to **WebP**
- Edit or delete posts (depending on your role)
- The old image file is removed from storage when it is replaced or the post is deleted

### Tags and search
- Add comma-separated tags to a post (duplicates and spaces are removed)
- Search posts by **category**, **title** or **tag**, or combine the filters

### Likes and comments
- Like or unlike a post with one click
- Like and comment counts are shown on every post
- Posts you already liked are highlighted
- Comment on posts (max 1000 characters) and delete comments (depending on your role)

### Administration (Admin only)
- Manage categories: create, edit and delete
- Manage users: view all users, change name and role, delete users

---

## User roles and permissions

| Action                                   | Normal   | Editor   | Admin    |
|------------------------------------------|:--------:|:--------:|:--------:|
| View posts and search                    | ✅       | ✅       | ✅       |
| Create posts                             | ✅       | ✅       | ✅       |
| Like / unlike posts                      | ✅       | ✅       | ✅       |
| Write comments                           | ✅       | ✅       | ✅       |
| Edit / delete posts                      | own only | ✅ all   | ✅ all   |
| Delete comments                          | own only | ✅ all   | ✅ all   |
| Edit profile / delete account            | own only | own only | own only |
| Manage categories                        | ❌       | ❌       | ✅       |
| View users, change roles, delete users   | ❌       | ❌       | ✅       |

New users get the **Normal** role by default. The first Admin account is created by the `FirstUser` seeder, and the Admin can change anyone's role later.

---

## Tech stack

- **PHP 8.2+**, **Laravel 12**
- **MySQL** database
- **Redis** cache (via `predis/predis`)
- **Laravel Breeze** authentication
- **Intervention Image 3** (GD driver) for image processing
- **Bootstrap 5** and Bootstrap Icons for the main UI, Tailwind (Breeze) for the auth and profile pages

---

## Architecture

### Middleware
- `auth` protects every page in the app.
- `AdminCheckMiddleware` (custom) protects all category and user management routes.

### Policies
Controllers check permissions with `Gate::authorize()`:

| Policy                 | Method           | Rule                                                        |
|------------------------|------------------|-------------------------------------------------------------|
| `PostModelPolicy`      | `editPost`       | User is not Normal, **or** is the author of the post        |
| `CommentModelPolicy`   | `updateComment`  | User is not Normal, **or** wrote the comment                |
| `CategoryModelPolicy`  | `updateCategory` | User is Admin                                               |
| `UserPolicy`           | `updateUser`     | User is Admin                                               |

### Repository pattern
Database logic is kept out of the controllers:
- `App\Repository\PostRepository`: search query (category, title and tag, with a join on `tags`), saving and updating tags, deleting a post with its tags, toggling likes
- `App\Repository\CommentRepository`: creating comments

### Redis cache
Frequently read data is cached with `Cache::remember()` for 10 minutes:

| Cache key    | Content                                   |
|--------------|-------------------------------------------|
| `posts`      | All posts with like and comment counts    |
| `categories` | List of categories (sports)               |
| `users`      | List of users in the admin panel          |

### Observers
Observers are registered in `AppServiceProvider` and delete the related cache key on `created`, `updated` and `deleted` events:

| Observer           | Model           | Clears key   |
|--------------------|-----------------|--------------|
| `PostObserver`     | `PostModel`     | `posts`      |
| `LikeObserver`     | `LikeModel`     | `posts`      |
| `CategoryObserver` | `CategoryModel` | `categories` |
| `UserObserver`     | `User`          | `users`      |

### Validation (Form Requests)
- `SavePostRequest`: title (max 50), description (max 1000), existing category, required image (jpeg, png, jpg or gif, max 5 MB)
- `EditPostRequest`: the same rules, but the image is optional
- `CreateCommentRequest`: comment is required, max 1000 characters
- `ProfileUpdateRequest`: name and a unique email

### Eloquent
- **Relationships:** `PostModel` has many tags, likes and comments; `LikeModel` and `CommentModel` belong to a user
- **Local scopes:** `PostModel::GetAllPosts()` loads posts with `withCount('likes')` and `withCount('comments')`. `LikeModel::GetLikedPosts()` returns the likes of the logged-in user.
- **Constants:** roles are defined as `User::ADMIN`, `User::EDITOR` and `User::NORMAL`

### Trait
`ImageUploadTrait` converts uploaded images to WebP (quality 90), gives each file a unique name and stores it on the `public` disk.

---

## Database

| Table        | Description                                 |
|--------------|---------------------------------------------|
| `users`      | Users, including the `role` column (admin / editor / normal) |
| `categories` | Sports (categories)                         |
| `posts`      | Posts (title, description, image, category, author) |
| `tags`       | Post tags                                   |
| `likes`      | Likes (user and post)                       |
| `comments`   | Comments (user, post and text)              |

---

## Installation

### Requirements
- PHP 8.2+ with the GD extension
- Composer
- Node.js and npm
- MySQL
- Redis server

### Steps

```bash
# 1. Clone the repository
git clone https://github.com/acke123/LaravelSportBlog.git
cd LaravelSportBlog

# 2. Install dependencies
composer install
npm install

# 3. Create the environment file and app key
cp .env.example .env
php artisan key:generate
```

4. Set the database and Redis values in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sportblog
DB_USERNAME=root
DB_PASSWORD=

CACHE_STORE=redis
REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

```bash
# 5. Run the migrations
php artisan migrate

# 6. Create the Admin account (and optional test users)
php artisan db:seed --class=FirstUser
php artisan db:seed --class=UserSeeder

# 7. Link the storage folder so uploaded images are public
php artisan storage:link

# 8. Build the front-end assets
npm run build

# 9. Start the app
php artisan serve
```

Open http://127.0.0.1:8000 in your browser.

### Default Admin account

| Email             | Password          |
|-------------------|-------------------|
| `admin@admin.com` | `admin@admin.com` |

> Change this password after the first login.

---

## Project structure (main parts)

```
app/
├── Http/
│   ├── Controllers/      PostController, CommentController, CategoryController, UserController, ProfileController
│   ├── Middleware/       AdminCheckMiddleware
│   └── Requests/         SavePostRequest, EditPostRequest, CreateCommentRequest, ProfileUpdateRequest
├── Models/               User, PostModel, CategoryModel, TagModel, LikeModel, CommentModel
├── Observers/            PostObserver, LikeObserver, CategoryObserver, UserObserver
├── Policies/             PostModelPolicy, CommentModelPolicy, CategoryModelPolicy, UserPolicy
├── Repository/           PostRepository, CommentRepository
├── Traits/               ImageUploadTrait
└── Providers/            AppServiceProvider (observer registration)
resources/views/
├── posts/                create, edit, display post
├── category/             category management (Admin)
├── users/                user management (Admin)
├── viewParts/            navbar, footer
├── welcome.blade.php     home page with posts and search
└── aboutUs.blade.php     About page
```
