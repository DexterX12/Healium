@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h2>{{ __('Edit Drug') }}</h2>
    <form action="{{ route('admin.drug.update', ['id' => $viewData['drug']->getId()]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Drug Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $viewData['drug']->getName() }}" required>
        </div>
        <div class="mb-3">
            <label for="supplier" class="form-label">{{ __('Supplier') }}</label>
            <select class="form-select" id="supplier" name="supplier_id" required>
                @foreach($viewData['suppliers'] as $supplier)
                    <option value="{{ $supplier->getId() }}"
                        @if($supplier->getId() == $viewData['drug']->getSupplierId()) selected @endif>
                        {{ $supplier->getName() }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $viewData['drug']->getDescription() }}</textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">{{ __('Category') }}</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $viewData['drug']->getCategory() }}" required>
        </div>
        <div class="mb-3">
            <label for="chemical_details" class="form-label">{{ __('Chemical Details') }}</label>
            <textarea class="form-control" id="chemical_details" name="chemical_details" rows="2" required>{{ $viewData['drug']->getChemicalDetails() }}</textarea>
        </div>
        <div class="mb-3">
            <label for="keywords" class="form-label">{{ __('Keywords') }}</label>
            <input type="text" class="form-control" id="keywords" name="keywords" value="{{ $viewData['drug']->getKeywords() }}" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">{{ __('Price') }}</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $viewData['drug']->getPrice() }}" required>
        </div>
       <div class="mb-3">
            <label for="price" class="form-label">{{ __('Stock') }}</label>
            <input type="number" step="1" class="form-control" id="stock" name="stock" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">{{ __('Drug Image') }}</label>
            @if($viewData['drug']->getImage())
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $viewData['drug']->getImage()) }}" alt="{{ __('Drug Image') }}" style="max-width: 200px;">
                </div>
            @endif
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Update Drug') }}</button>
    </form>
</div>
@endsection