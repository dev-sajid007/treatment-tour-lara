<!-- resources/views/clinic/dashboard/index.blade.php -->
@extends('layouts.admin')
    @section('title', 'Dashboard')
    @section('content')

    <div class="container-fluid">
        {{-- Start Filtering --}}
        <form action="{{ route('clinic.dashboard') }}" method="GET">
            @csrf
            @php
                $selectedResultFor = request('resultfor') ?? 'last3months';
            @endphp
            <div class="row">
                <div class="col-md-3">
                    <label for="resultfor">Show Result By</label>
                   <select name="resultfor" id="resultfor" class="form-control">
                        <option value="today" {{ $selectedResultFor == 'today' ? 'selected' : '' }}>Today's</option>
                        <option value="last7days" {{ $selectedResultFor == 'last7days' ? 'selected' : '' }}>Last 7 days</option>
                        <option value="currentMonth" {{ $selectedResultFor == 'currentMonth' ? 'selected' : '' }}>Current Month</option>
                        <option value="last3months" {{ $selectedResultFor == 'last3months' ? 'selected' : '' }}>Last 3 Months</option>
                        <option value="last6months" {{ $selectedResultFor == 'last6months' ? 'selected' : '' }}>Last 6 Months</option>
                        <option value="thisYear" {{ $selectedResultFor == 'thisYear' ? 'selected' : '' }}>This Year</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="action">Action</label>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </div>
        </form>
        <br>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3 border">
                    <div class="card-body p-3">
                        <canvas id="myChart2" style="width:100%; height: 600px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="{{ asset('assets/js/Chart.min.js') }}"></script> 

   
@endsection
