@extends('layouts.app')
@section('content')
<div class="container py-5">
	<h1 class="mb-4 text-center fw-bold text-primary">{{ __('Our Products') }}</h1>
		
	<form method="GET" action="{{ route('drug.index') }}" class="row mb-4 justify-content-center">
		<div class="col-md-4 mb-2 mb-md-0">
			<input type="text" name="name" class="form-control" placeholder="{{ __('Search drugs...') }}" value="{{ request('name') }}">
		</div>
		<div class="col-md-3 mb-2 mb-md-0">
			<select name="sales_filter" class="form-select">
				<option value="">{{ __('Filter by sales') }}</option>
				<option value="asc" {{ request('sales_filter') == 'asc' ? 'selected' : '' }}>Lowest sales</option>
				<option value="desc" {{ request('sales_filter') == 'desc' ? 'selected' : '' }}>Highest sales</option>
			</select>
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-primary w-100">{{ __('Apply') }}</button>
		</div>
	</form>
	<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
		@foreach($viewData['drugs'] as $drug)
			<div class="col">
				<a href="{{route('drug.show', ['id' => $drug->getId()])}}" class="text-decoration-none">
					<div class="card h-100 shadow-sm">
						@if($drug->getImage())
							<img src="{{ asset('/storage/'.$drug->getImage()) }}" class="card-img-top" alt="{{ $drug->getName() }}" style="object-fit:cover;height:250px;">
						@endif
						<div class="card-body text-center">
							<h5 class="card-title fw-semibold">{{ $drug->getName()}}</h5>
							<span class="badge text-bg-success">{{ $drug->getCategory() }}</span>
							<div class="mt-2">
								<span class="fw-bold">${{ $drug->getPrice() }} COP</span>
								@if(method_exists($drug, 'getSalesAmount'))
									<div class="text-muted small">{{ __('Sales') }}: {{ $drug->getSalesAmount() }}</div>
								@endif
							</div>
						</div>
					</div>
				</a>
			</div>
		@endforeach
	</div>
</div>
@endsection
