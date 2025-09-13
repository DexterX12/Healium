@extends('layouts.app')
@section('content')
    <header class="bg-light py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold text-primary">Welcome to Healium</h1>
            <p class="lead text-secondary">Your trusted drug store for health and wellness</p>
        </div>
    </header>

    <section class="container my-5">
        <h2 class="mb-4 text-center fw-semibold">New Products</h2>
        <div id="drugCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach(array_chunk($viewData['drugs'], 3) as $chunkIndex => $drugsChunk)
                    <div class="carousel-item @if($chunkIndex == 0) active @endif">
                        <div class="row justify-content-center">
                            @foreach($drugsChunk as $index => $drug)
                                <div class="col-md-6 col-lg-4 @if($index > 0) d-none d-md-block @endif @if($index > 1) d-none d-lg-block @endif">
                                    <div class="card shadow-sm">
                                        <img src="{{ $drug->getImage() }}" class="card-img-top" alt="{{ $product->getName() }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $drug->getName() }}</h5>
                                            <p class="card-text">{{ $drug->getDescription() }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>
@endsection
