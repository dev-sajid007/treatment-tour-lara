@extends('layouts.admin')
    @section('title', 'Dashboard')
    @section('content')
    <div class="container-fluid">
        <!-- Display counts with colorful design and links -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center text-white bg-primary mb-3">
                    <div class="card-body">
                        <i class="fas fa-file-alt fa-3x mb-2"></i>
                        <h5 class="card-title">Total Quotes</h5>
                        <p class="card-text display-4">{{ $quoteCount }}</p>
                        <a href="{{ route('clinics.quote.index') }}" class="btn btn-outline-light btn-sm">View Quotes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center text-white bg-success mb-3">
                    <div class="card-body">
                        <i class="fas fa-briefcase fa-3x mb-2"></i>
                        <h5 class="card-title">Total Portfolios</h5>
                        <p class="card-text display-4">{{ $portfolioCount }}</p>
                        <a href="{{ route('clinics.portfolios.index') }}" class="btn btn-outline-light btn-sm">View Portfolios</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center text-white bg-info mb-3">
                    <div class="card-body">
                        <i class="fas fa-user-md fa-3x mb-2"></i>
                        <h5 class="card-title">Total Doctors</h5>
                        <p class="card-text display-4">{{ $doctorCount }}</p>
                        <a href="{{ route('clinics.doctors.index') }}" class="btn btn-outline-light btn-sm">View Doctors</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
