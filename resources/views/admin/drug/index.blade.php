@extends('layouts.admin')
@section('content')
<div class="mb-3">
    <h2 class="text-center">Currently listed drugs</h2>
    <div class="d-flex justify-content-end mt-2">
        <a href="{{ route('admin.drug.create') }}" class="btn btn-primary">Add Drug</a>
    </div>
</div>
<div class="list-group">
    @foreach($viewData['drugs'] as $drug)
        <a href="{{ route('admin.drug.show', ['id' => $drug->getId()]) }}" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $drug->getName() }}</h5>
                <small class="text-muted">${{ number_format($drug->getPrice(), 2) }}</small>
            </div>
        </a>
    @endforeach
</div>
@endsection