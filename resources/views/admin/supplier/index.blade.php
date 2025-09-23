@extends('layouts.admin')
@section('content')
<div class="mb-3">
    <h2 class="text-center">{{ __('Currently registered suppliers') }}</h2>
    <div class="d-flex justify-content-end mt-2">
        <a href="{{ route('admin.supplier.create') }}" class="btn btn-primary">{{ __('Add Supplier') }}</a>
    </div>
</div>
<div class="list-group">
    @foreach($viewData['suppliers'] as $supplier)
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">{{ $supplier->getName() }}</h5>
                <small class="text-muted">{{ $supplier->getEmail() }}</small>
            </div>
            <div>
                <a href="{{ route('admin.supplier.edit', ['id' => $supplier->getId()]) }}" class="btn btn-sm btn-outline-primary me-2">{{ __('Edit') }}</a>
                <form action="{{ route('admin.supplier.delete', ['id' => $supplier->getId()]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(`{{ __('Are you sure you want to delete this supplier?') }}`)">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection