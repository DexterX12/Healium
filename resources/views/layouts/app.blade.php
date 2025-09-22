
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Healium Drug Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{route('home.index')}}">Healium</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('home.index') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('drug.index') }}">Products</a></li>

                    <div class="vr bg-white mx-2 d-none d-lg-block"></div>
                    @guest
                    <li><a class="nav-link active" href="{{ route('login') }}">Login</a></li>
                    <li><a class="nav-link active" href="{{ route('register') }}">Register</a></li>
                    @else
                    <li>
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#cartModal">
                            <i class="bi bi-cart"></i> Cart
                        </a>
                    </li>
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        <a role="button" class="nav-link active"
                        onclick="document.getElementById('logout').submit();">Logout</a>
                        @csrf
                    </form>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


    <main class="container">
        @yield('content')
    </main>


    <footer class="bg-primary text-white mt-5 pt-4 pb-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="fw-bold mb-1">Healium Pharmacy</h5>
                    <p class="mb-0 small">
                        Quality medicines, caring for your health.<br>
                        <i class="bi bi-geo-alt"></i> Bogotá, Colombia
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="me-2">Follow us:</span>
                    <a href="#" class="text-white me-2"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-twitter fs-5"></i></a>
                </div>
            </div>
            <hr class="border-light my-3">
            <div class="text-center small">
                &copy; {{ date('Y') }} Healium Pharmacy. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @include('cart.modal')
</body>
</html>