@extends('layouts.admin')
@section('content')
<div class="mb-3">
  <h2 class="text-center">{{ __('Currently listed drugs') }}</h2>
  <div class="d-flex justify-content-end mt-2">
    <a href="{{ route('admin.drug.create') }}" class="btn btn-primary">{{ __('Add Drug') }}</a>
  </div>
</div>
<div class="list-group">
  @foreach($viewData['drugs'] as $drug)
    <div class="list-group-item d-flex justify-content-between align-items-center">
      <div>
        <h5 class="mb-1">{{ $drug->getName() }}</h5>
        <small class="text-muted">${{ number_format($drug->getPrice(), 2) }}</small>
      </div>
      <div>
        <a href="{{ route('admin.drug.edit', ['id' => $drug->getId()]) }}" class="btn btn-sm btn-outline-primary me-2">{{ __('Edit') }}</a>
        <form action="{{ route('admin.drug.delete', ['id' => $drug->getId()]) }}" method="POST" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(`{{ __('Are you sure you want to delete this drug?') }}`)">{{ __('Delete') }}</button>
        </form>
      </div>
    </div>
  @endforeach
</div>
@endsection