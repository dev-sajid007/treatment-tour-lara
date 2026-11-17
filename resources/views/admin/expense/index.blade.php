@extends('layouts.admin')
    <!-- Wrapper Start -->
    @section('title', 'All Expenses')
    @section('content')
    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-10 mx-auto">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">All Expenses</h4>
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
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date">Select Date</label>
                                            <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Action</label>
                                        <br>
                                        <button type="button" class="btn btn-primary" onclick="filterExpenses()">Filter</button>
                                        <button type="button" class="btn btn-secondary" onclick="resetFilters()">Reset</button>
                                    </div>
                                </div>
                                <br>

                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th class="details-preview">Details</th>
                                                <th class="attachment-column">Attachment</th>
                                                <th class="action-column">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expenses as $expense)
                                            <tr>
                                                <td>{{ $expense->id }}</td>
                                                <td>{{ $expense->title }}</td>
                                                <td>{{ $expense->date }}</td>
                                                <td>{{ $settings->currency }}{{ $expense->by_employee_or_office }}</td>
                                                <td class="details-preview">
                                                    <span class="details-preview" data-toggle="tooltip" data-placement="top" title="{{ $expense->details }}">
                                                        {{ \Illuminate\Support\Str::limit($expense->details, 30) }}
                                                    </span>
                                                </td>
                                                <td class="attachment-column">
                                                    @if ($expense->attachment)
                                                        <a href="{{ Storage::url('img/' . $expense->attachment) }}" download>Download Attachment</a>
                                                    @else
                                                        No Attachment
                                                    @endif
                                                </td>
                                                <td class="action-column">
                                                    <div class="d-flex">
                                                        <form id="deleteForm{{ $expense->id }}" action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-outline-danger delete-btn" onclick="confirmDelete({{ $expense->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        // Function to handle filter button click
        function filterExpenses() {
            // Get selected values
            var date = document.getElementById('date').value;

            // Redirect to the filtered URL
            window.location.href = '{{ route("expenses.all") }}' + '?date=' + date;
        }

        // Function to handle reset button click
        function resetFilters() {
            // Reset select elements
            document.getElementById('date').value = '';

            // Redirect to the original URL
            window.location.href = '{{ route("expenses.all") }}';
        }

        // Set selected values on page load
        document.addEventListener('DOMContentLoaded', function() {
            setSelectedValues();
        });

        function setSelectedValues() {
            const urlParams = new URLSearchParams(window.location.search);
            const date = urlParams.get('date');

            // Set selected date
            if (date) {
                document.getElementById('date').value = date;
            }
        }
    </script>

    <script>
        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
@endsection
