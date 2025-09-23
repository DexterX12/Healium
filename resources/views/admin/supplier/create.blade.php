
@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h2>{{ __('Create Supplier') }}</h2>
    <form action="{{ route('admin.supplier.save') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Supplier Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('E-mail') }}</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">{{ __('Address') }}</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Create Supplier') }}</button>
    </form>
</div>
@endsection