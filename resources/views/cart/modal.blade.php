<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="cartModalLabel">{{ __('Cart') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
        </div>
        
        <div class="modal-body">
            @if($viewData['cart_items']->isEmpty())
                <p>{{ __('Your cart is empty.') }}</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Drug') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Total') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData['cart_items'] as $item)
                            <tr>
                                <td>{{ $item->drug->getName() }}</td>
                                <td>{{ $item->getQuantity() }}</td>
                                <td>${{ number_format($item->getTotal(), 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item->getId()) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>

                {{-- Checkout Form --}}
                <form action="{{ route('order.checkout') }}" method="POST" id="checkoutForm">
                    @csrf

                    <div class="mb-3">
                        <label for="description" class="form-label"><strong>{{ __('Description') }}</strong></label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="{{ __('Add notes for the pharmacist or delivery team...') }}"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('Payment') }}</strong></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment" id="paymentCash" value="cash" checked>
                            <label class="form-check-label" for="paymentCash">{{ __('Cash') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment" id="paymentCard" value="card">
                            <label class="form-check-label" for="paymentCard">{{ __('Card') }}</label>
                        </div>
                    </div>
                </form>
            @endif
        </div>

        <div class="modal-footer">
            @if(!$viewData['cart_items']->isEmpty())
                <form action="{{ route('cart.removeAll') }}" method="POST" class="me-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('Clear Cart') }}</button>
                </form>
                <button type="submit" form="checkoutForm" class="btn btn-primary">{{ __('Proceed to Checkout') }}</button>
            @endif
        </div>
        </div>
    </div>
</div>
