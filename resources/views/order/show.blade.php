@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 d-flex flex-column justify-content-center">
            <h2>{{ __('Order ID') }}: {{ $viewData['order']->getId() }}</h2>
            <p><strong>{{ __('Payment') }}:</strong> {{ $viewData['order']->getPayment() }}</p>
            <p><strong>{{ __('Description') }}:</strong> {{ $viewData['order']->getDescription() ?? __('There is no description for this order') }}</p>
            <h4>{{ __('Purchased drugs') }}:</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('Drug') }}</th>
                        <th>{{ __('Quantity') }}</th>
                        <th>{{ __('Total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewData['items'] as $item)
                        <tr>
                            <td>{{ $item->getDrug()->getName() }}</td>
                            <td>{{ $item->getQuantity() }}</td>
                            <td>${{ number_format($item->getTotal(), 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection