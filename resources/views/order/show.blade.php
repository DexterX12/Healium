@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 d-flex flex-column justify-content-center">
            <h2>Order ID: {{ $viewData['order']->getId() }}</h2>
            <p><strong>Payment:</strong> {{ $viewData['order']->getPayment() }}</p>
            <p><strong>Description:</strong> {{ $viewData['order']->getDescription() ?? 'There is no description for this order' }}</p>
            <h4>Purchased drugs:</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Drug</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewData['items'] as $item)
                        <tr>
                            <td>{{ $item->drug->getName() }}</td>
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