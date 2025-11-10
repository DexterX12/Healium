@extends('layouts.app')
@section('content')

<div class="container mt-5">
  <h2 class="mb-4 text-center">{{ $viewData['store_info']['storeName'] }}</h2>

  <div class="row">
    @foreach($viewData['products'] as $product)
      <div class="col-md-6 mb-4">
        <div class="card shadow-lg border-0 rounded-4 p-3">
          <div class="row g-3 align-items-center">
            <div class="col-md-7">
              <h4>{{ $product['name'] }}</h4>
              <h6><span class="badge text-bg-success">{{ $product['category'] }}</span></h6>
              <p class="text-muted mb-2"> {{ $product['description'] }}</p>
              <h5 class="text-primary mb-2">${{ number_format($product['price'], 0, ',', '.') }}</h5>
              <p><strong>Stock:</strong> {{ $product['stock'] }}</p>

              @if(isset($product['specs']))
                <ul class="small text-secondary">
                  @foreach($product['specs'] as $key => $value)
                    <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                  @endforeach
                </ul>
              @endif

              <a href="{{ $product['link'] }}" target="_blank" class="btn btn-outline-primary btn-sm mt-2">
                {{ __('See product') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="text-center mt-4">
    <a href="{{ $viewData['store_info']['storeProductsLink'] }}" target="_blank" class="btn btn-success">
      {{ __('See all products in') }} {{ $viewData['store_info']['storeName'] }}
    </a>
  </div>
</div>

@endsection
