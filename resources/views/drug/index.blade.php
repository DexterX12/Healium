@extends('layouts.app')
@section('content')
	<div class="container py-5">
		<h1 class="mb-4 text-center fw-bold text-primary">Our Products</h1>
		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
			@foreach($viewData['drugs'] as $drug)
			<div class="col">
				<a href="#" class="text-decoration-none">
					<div class="card h-100 shadow-sm">
						<img src="{{ $drug['image'] }}" class="card-img-top" alt="{{ $drug['name'] }}" style="object-fit:cover;height:250px;">
						<div class="card-body text-center">
							<h5 class="card-title fw-semibold">{{ $drug->getName()}}</h5>
							<span class="badge {{ $drug['badge_class'] }}">{{ $drug->getCategory() }}</span>
							<div class="mt-2">
								<span class="fw-bold text-success">${{ $drug->getPrice() }}</span>
							</div>
						</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
@endsection
