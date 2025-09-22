<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="cartModalLabel">Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
            @if($viewData['cart_items']->isEmpty())
            <p>Your cart is empty.</p>
            @else
            <table class="table">
                <thead>
                <tr>
                    <th>Drug</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($viewData['cart_items'] as $item)
                    <tr>
                    <td>{{ $item->drug->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>

        <div class="modal-footer">
            <form action="{{ route('cart.removeAll') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Clear Cart</button>
            </form>
            <a href="{{ route('order.save') }}" class="btn btn-primary">Proceed to Checkout</a>
        </div>
        </div>
    </div>
</div>
