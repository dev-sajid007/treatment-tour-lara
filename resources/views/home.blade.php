@extends('layouts.admin')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    @php
                        $hospital = null;
                        if (!is_null($user->hospital_id)) {
                            $hospital = \App\Models\Hospital::where('status', 'Pending')
                                        ->where('id', $user->hospital_id)
                                        ->first();
                        }
                    @endphp

                    @if ($hospital)
                        <div class="alert alert-warning mt-3">
                            {{ __('Hospital not approved yet') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
