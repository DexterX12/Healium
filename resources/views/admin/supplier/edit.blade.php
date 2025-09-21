@extends('layouts.admin')
@section('content')
<div class="mb-3">
    <h2>Update supplier</h2>
</div>
<form action="{{ route('admin.supplier.update', ['id' => $viewData['supplier']->getId()]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $viewData['supplier']->getName() }}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $viewData['supplier']->getEmail() }}" required>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="{{ $viewData['supplier']->getAddress() }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Supplier</button>
</form>
@endsection