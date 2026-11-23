@php use Illuminate\Support\Facades\Auth; @endphp
<style>
    body {
        background-color: #f4f6fb;
        font-family: Arial, sans-serif;
    }

    .navbar {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .post-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .post-card:hover {
        transform: translateY(-4px);
    }

    .post-card .card-header {
        background: #fff;
        font-weight: 600;
        border-bottom: 1px solid #eee;
    }

    .post-card img {
        height: 180px;
        width: 100%;
        object-fit: cover;
    }

    .post-card .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold pe-auto" href="sportBlogView.php">
            {{ Auth::user()->name }}
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="displayUsers.php">Users</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="displayUsers.php">New category</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit')}}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('aboutUs') }}">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
