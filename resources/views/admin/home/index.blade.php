@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4>{{ __('Welcome, Admin!') }}</h4>
                    </div>
                    <div class="card-body">
                        <p class="lead">{{ __('You are logged in to the admin dashboard. Use the navigation menu to manage the application') }}.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5><i class="fas fa-users"></i> {{ __('Total Registered Users') }}</h5>
                    </div>
                    <div class="card-body text-center">
                        <h2 class="display-4 text-success">{{ $viewData['total_users'] }}</h2>
                        <p class="text-muted">{{ __('Users registered in the system') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5><i class="fas fa-chart-bar"></i> {{ __('Top 5 Most Sold Drugs') }}</h5>
                    </div>
                    <div class="card-body">
                        @if($viewData['top_drugs']->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Drug Name') }}</th>
                                            <th>{{ __('Total Sold') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($viewData['top_drugs'] as $index => $drug)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $drug->getName() }}</td>
                                                <td>
                                                    <span class="badge bg-primary rounded-pill">
                                                        {{ $drug->total_sold }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted">
                                <i class="fas fa-info-circle fa-3x mb-3"></i>
                                <p>{{ __('No sales data available yet')}}.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection