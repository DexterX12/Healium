@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4><i class="bi bi-chat-dots"></i> Add a Comment</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('drug.comment', ['id' => $drug->getId()]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="drug_id" value="{{ $drug->getId() }}">
                        <div class="mb-3">
                            <label class="form-label">Drug</label>
                            <input type="text" class="form-control" value="{{ $drug->getName() }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="commentDescription" class="form-label">Your Comment</label>
                            <textarea name="description" id="commentDescription" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('drug.show', ['id' => $drug->getId()]) }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection