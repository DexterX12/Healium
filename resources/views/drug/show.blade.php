@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 d-flex align-items-center justify-content-center">
            <img src="/{{ $viewData['drug']->getImage() }}" alt="{{ $viewData['drug']->getName() }}" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-4 d-flex flex-column justify-content-center">
            <h2>{{ $viewData['drug']->getName() }} <h6><span class="badge text-bg-success">{{ $viewData['drug']->getCategory() }}</span></h6></h2>
            <p class="text-muted">{{ $viewData['drug']->getDescription() }}</p>
            <h4 class="mb-3">${{ $viewData['drug']->getPrice() }} COP</h4>
            <a href="#" class="btn btn-primary btn-lg">Buy Now</a>
        </div>
    </div>
</div>

@endsection