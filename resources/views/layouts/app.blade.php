<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Healium Drug Store') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column min-vh-100">
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="{{route('home.index')}}">{{ __('Healium') }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="{{ route('home.index') }}">{{ __('Home') }}</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('drug.index') }}">{{ __('Products') }}</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('partner.index') }}">{{ __('Partner') }}</a></li>
          @guest
            <li><a class="nav-link active" href="{{ route('login') }}">{{ __('Login')}}</a></li>
            <li><a class="nav-link active" href="{{ route('register') }}">{{ __('Register')}}</a></li>
          @else
            <li><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#cartModal">{{ __('Cart') }}</a></li>
            <li><a class="nav-link" href="{{ route('order.index') }}">{{ __('Orders') }}</a></li>
            <form id="logout" action="{{ route('logout') }}" method="POST">
              <a role="button" class="nav-link active" onclick="document.getElementById('logout').submit();">{{ __('Logout') }}</a>
              @csrf
            </form>
          @endguest
        </ul>
      </div>
    </div>
  </nav>


  <div id="app">
    <div class="d-flex justify-content-end p-3">
      <div class="card shadow-sm border-0" style="min-width: 260px;">
        <div class="card-body py-2 px-3">
          <form action="{{ route('set.locale', ['locale' => '']) }}" method="POST" class="d-flex justify-content-between align-items-center">
            @csrf
            <button type="submit" name="lang" value="en" class="btn btn-outline-primary mx-1">
              <i class="bi bi-translate"></i> English
            </button>
            <button type="submit" name="lang" value="es" class="btn btn-outline-success mx-1">
              <i class="bi bi-translate"></i> Español
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <main class="container">
    @if($errors->any())
      <ul id="errors" class="alert alert-danger list-unstyled">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @elseif(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @elseif(session('fail'))
    <div class="alert alert-danger">
      {{ session('fail') }}
    </div>
    @endif
    @yield('content')
  </main>


  <footer class="bg-primary text-white mt-5 pt-4 pb-3">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 mb-3 mb-md-0">
          <h5 class="fw-bold mb-1">{{ __('Healium Pharmacy') }}</h5>
            <p class="mb-0 small">
              {{ __('Quality medicines, caring for your health.') }}<br>
              <i class="bi bi-geo-alt"></i> {{ __('Bogotá, Colombia') }}
            </p>
        </div>
        <div class="col-md-6 text-md-end">
          <span class="me-2">{{ __('Follow us:') }}</span>
          <a href="#" class="text-white me-2"><i class="bi bi-facebook fs-5"></i></a>
          <a href="#" class="text-white me-2"><i class="bi bi-instagram fs-5"></i></a>
          <a href="#" class="text-white"><i class="bi bi-twitter fs-5"></i></a>
        </div>
      </div>
      <hr class="border-light my-3">
      <div class="text-center small">
        &copy; {{ date('Y') }} {{ __('Healium Pharmacy. All rights reserved.') }}
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @include('cart.modal')
</body>
</html>
