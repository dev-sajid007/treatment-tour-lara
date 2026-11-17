@extends('layouts.admin')
    <!-- Wrapper Start -->
    @section('title', 'Add Expense')
    @section('content')
    
    <div class="wrapper">
        <div class="content-page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 mx-auto">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Add Expense</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                <div class="alert text-white bg-success" role="alert">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="iq-success-text">{{ session('success') }}</div>
                                        <button type="button" class="close btn btn-danger ms-4" aria-label="Close" onclick="closeAlert(this)">
                                            X
                                        </button>
                                    </div>
                                </div>
                                @endif

                                @if ($errors->any())
                                <div class="alert text-white bg-danger" role="alert">
                                    @foreach ($errors->all() as $error)
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="iq-alert-text">{{ $error }}</div>
                                        <button type="button" data-dismiss="alert" class="close btn btn-danger ms-4" aria-label="Close" onclick="closeAlert(this)">
                                            X
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                                <br>
                                 <form action="{{ route('expenses.store') }}" method="post" id="addExpenseForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                                @error('title')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                                                @error('date')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="by_employee_or_office">Amount</label>
                                                <input type="number" class="form-control" id="by_employee_or_office" name="by_employee_or_office" value="{{ old('by_employee_or_office') }}" required>
                                                @error('by_employee_or_office')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                         </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="attachment">Attachment</label>
                                                <input type="file" class="form-control" id="attachment" name="attachment">
                                                @error('attachment')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="details">Details</label>
                                                <textarea class="form-control" id="details" rows="8" name="details">{{ old('details') }}</textarea>
                                                @error('details')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                         </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Add Expense</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper End-->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Tom Select for the bank dropdown
            let bankSelect = new TomSelect('#bank_id');
        });

        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
@endsection
