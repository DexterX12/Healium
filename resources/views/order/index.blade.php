@extends('layouts.app')
@section('content')
	<div class="container py-5">
		<h1 class="mb-4 text-center fw-bold text-primary">{{ __('Your Orders') }}</h1>
		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
			@foreach($viewData['orders'] as $order)
			<div class="col">
				<a href="{{route('order.show', ['id' => $order->getId()])}}" class="text-decoration-none">
					<div class="card h-100 shadow-sm">
						<div class="card-body text-center">
							<h5 class="card-title fw-semibold">{{ __('Order ID') }}: {{ $order->getId()}}</h5>
							<div class="mt-2">
								<span class="fw-bold">{{ __('Creation date') }}: {{ $order->getCreatedAtTimestamp() }}</span>
							</div>
						</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
@endsection
