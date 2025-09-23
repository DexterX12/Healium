@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 d-flex align-items-center justify-content-center">
            @if($viewData['drug']->getImage())
                <img src="{{ asset('/storage/'.$viewData['drug']->getImage()) }}" alt="{{ $viewData['drug']->getName() }}" class="img-fluid rounded shadow">
            @endif
        </div>
        <div class="col-md-4 d-flex flex-column justify-content-center">
            <h2>{{ $viewData['drug']->getName() }} <h6><span class="badge text-bg-success">{{ $viewData['drug']->getCategory() }}</span></h6></h2>
            <p class="text-muted">{{ $viewData['drug']->getDescription() }}</p>
            <h4 class="mb-3">${{ $viewData['drug']->getPrice() }} COP</h4>
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addToCartModal">
                {{ __('Buy now') }}
            </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToCartLabel">{{ __('Add to Cart') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('cart.add', ['id' => $viewData['drug']->getId()]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p><strong>{{ $viewData['drug']->getName() }}</strong></p>
                    <p>{{ __('Price') }}: ${{ $viewData['drug']->getPrice() }} COP</p>
                    
                    <div class="mb-3">
                        <label for="quantity" class="form-label">{{ __('Quantity') }}</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection