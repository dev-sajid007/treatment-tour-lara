<!-- resources/views/salepoint/dashboard/index.blade.php -->
<x-salepoint>
    @section('title', 'Dashboard')

    <div class="container-fluid">
        {{-- Start Filtering --}}
        <form action="{{ route('salepoint.dashboard') }}" method="GET">
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

        {{-- Start Card Section --}}
        <div class="row my-3">
            <!-- Total Sales -->
            <div class="col-md-4">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Sale's</h6>
                        <h2 class="text-right"><i class="fas fa-clipboard-check"></i> <span> {{$settings->currency}}{{$totalSales}}</span></h2>
                        <p class="m-b-0">Total Invoices<span class="f-right">{{$totalSaleInvoices}}</span></p>
                    </div>
                </div>
            </div>

            <!-- Total Returns -->
            <div class="col-md-4">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Sale Returns</h6>
                        <h2 class="text-right"><i class="fas fa-clipboard-check"></i> <span> {{$settings->currency}}{{$totalReturns}}</span></h2>
                        <p class="m-b-0">Total Invoices<span class="f-right">{{$totalReturnInvoices}}</span></p>
                    </div>
                </div>
            </div>
            <!-- Remaining Amount -->
            <div class="col-md-4">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Remaining Amount</h6>
                        <h2 class="text-right"><i class="fas fa-clipboard-check"></i> <span> {{$settings->currency}}{{$remainingAmount}}</span></h2>
                        <p><a href="{{route('salepoint_customer_index')}}" class="m-b-0">Collect Now<span class="f-right"></span></a></p>
                        
                    </div>
                </div>
            </div>
        </div>
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

    <script src="{{ asset('assets/js/loader.js') }}"></script> 
    <script src="{{ asset('assets/js/Chart.min.js') }}"></script> 

    <script>
        const salesByDay = @json($salesByDay);

        new Chart("myChart2", {
            type: "line",
            data: {
                labels: salesByDay.map(sale => sale.day),
                datasets: [{
                    label: 'Total Sales',
                    fill: false,
                    borderColor: "rgba(0,0,255,0.5)",
                    data: salesByDay.map(sale => sale.total)
                }]
            },
            options: {
                legend: {display: true},
                title: {
                    display: true,
                    text: "Sales Report This Month",
                    fontSize: 16
                }
            }
        });
    </script>
</x-salepoint>
