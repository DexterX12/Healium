@extends('layouts.admin')
@section('content')
<h2 class="text-center">Currently registered suppliers</h2>
<div class="list-group">
    @foreach($viewData['suppliers'] as $supplier)
        <a href="{{ route('admin.supplier.show', ['id' => $supplier->getId()]) }}" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $supplier->getName() }}</h5>
                <small class="text-muted">{{ $supplier->getEmail() }}</small>
            </div>
        </a>
    @endforeach
</div>
@endsection