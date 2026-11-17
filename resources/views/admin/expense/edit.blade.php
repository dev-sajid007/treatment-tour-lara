@extends('layouts.admin')
    <!-- Wrapper Start -->
    @section('title', 'Edit Expense')
    @section('content')
    
    <div class="wrapper">
        <div class="content-page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 mx-auto">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Edit Expense</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert text-white bg-danger" role="alert">
                                    @foreach ($errors->all() as $error)
                                    <div class="iq-alert-text">{{ $error }}</div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ri-close-line"></i>
                                    </button>
                                    @endforeach
                                 </div>
                                 @endif
                                 <form action="{{ route('expenses.update', $expense->id) }}" method="post" id="editExpenseForm" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $expense->title) }}">
                                                @error('title')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $expense->date) }}">
                                                @error('date')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>    <br>
                                            <div class="form-group">
                                                <label for="by_employee_or_office">By</label>
                                                <input type="text" class="form-control" id="by_employee_or_office" name="by_employee_or_office" value="{{ old('by_employee_or_office', $expense->by_employee_or_office) }}">
                                                @error('by_employee_or_office')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>    <br>
                                            <div class="form-group">
                                                <label for="attachment">Attachment</label>
                                                <input type="file" class="form-control" id="attachment" name="attachment">
                                                @error('attachment')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                         </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="details">Details</label>
                                                <textarea class="form-control" id="details" rows="8" name="details">{{ old('details', $expense->details) }}</textarea>
                                                @error('details')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                         </div>
                                    </div>    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Expense</button>
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
@endsection
