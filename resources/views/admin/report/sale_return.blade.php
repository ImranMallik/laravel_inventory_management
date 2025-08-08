@extends('admin.layouts.master')
@section('content')
    <div class="content">
        <div class="row">
            <!-- Dashboard Cards -->
            <!-- Purchase -->
            <div class="col-md-4 col-lg-4">
                <div class="card mb-3" style="max-width: 400px; background-color: #00BCD4;">
                    <div class="row g-0">
                        <div class="col-4 d-flex align-items-center justify-content-center" style="height: 100px;">
                            <span class="mdi mdi-cart mdi-36px text-white"></span>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-3">
                                <h2 class="fs-16 mb-1 fw-semibold text-white">Purchase</h2>
                                <p class="fs-16 mb-0 fw-semibold text-white">
                                    <strong>{{ \App\Models\Purchase::count() }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Purchase Return -->
            <div class="col-md-4 col-lg-4">
                <div class="card mb-3" style="max-width: 400px; background-color: #FF7043;">
                    <div class="row g-0">
                        <div class="col-4 d-flex align-items-center justify-content-center" style="height: 100px;">
                            <span class="mdi mdi-cart-off mdi-36px text-white"></span>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-3">
                                <h2 class="fs-16 mb-1 fw-semibold text-white">Purchase Return</h2>
                                <p class="fs-16 mb-0 fw-semibold text-white">
                                    <strong>{{ \App\Models\ReturnPurchase::count() }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock -->
            <div class="col-md-4 col-lg-4">
                <div class="card mb-3" style="max-width: 400px; background-color: #4CAF50;">
                    <div class="row g-0">
                        <div class="col-4 d-flex align-items-center justify-content-center" style="height: 100px;">
                            <span class="mdi mdi-warehouse mdi-36px text-white"></span>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-3">
                                <h2 class="fs-16 mb-1 fw-semibold text-white">Stock</h2>
                                <p class="fs-16 mb-0 fw-semibold text-white">
                                    <strong>{{ \App\Models\Product::count() }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sale -->
            <div class="col-md-4 col-lg-4">
                <div class="card mb-3" style="max-width: 400px; background-color: #FFC107;">
                    <div class="row g-0">
                        <div class="col-4 d-flex align-items-center justify-content-center" style="height: 100px;">
                            <span class="mdi mdi-sale mdi-36px text-white"></span>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-3">
                                <h2 class="fs-16 mb-1 fw-semibold text-white">Sale</h2>
                                <p class="fs-16 mb-0 fw-semibold text-white">
                                    <strong>{{ \App\Models\Sale::count() }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sale Return -->
            <div class="col-md-4 col-lg-4">
                <div class="card mb-3" style="max-width: 400px; background-color: #F44336;">
                    <div class="row g-0">
                        <div class="col-4 d-flex align-items-center justify-content-center" style="height: 100px;">
                            <span class="mdi mdi-backspace mdi-36px text-white"></span>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-3">
                                <h2 class="fs-16 mb-1 fw-semibold text-white">Sale Return</h2>
                                <p class="fs-16 mb-0 fw-semibold text-white">
                                    <strong>{{ \App\Models\SaleReturn::count() }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation and Filters -->
        <div class="card mt-4">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Reports</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAlt"
                        aria-controls="navbarNavAlt" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNavAlt">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{ route('admin.all-report') }}"
                                    class="nav-link {{ Route::currentRouteName() === 'admin.all-report' ? 'active' : '' }}">
                                    @if (Route::currentRouteName() === 'admin.all-report')
                                        <span class="badge bg-primary">Purchase</span>
                                    @else
                                        Purchase
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.purchase-return.reports') }}"
                                    class="nav-link {{ Route::currentRouteName() === 'admin.purchase-return.reports' ? 'active' : '' }}">
                                    @if (Route::currentRouteName() === 'admin.purchase-return.reports')
                                        <span class="badge bg-primary">Purchase Return</span>
                                    @else
                                        Purchase Return
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item"><a href="{{route('admin.sale.report')}}" class="nav-link         
                                {{Route::currentRouteName() === 'admin.sale.report' ? 'active' : '' }}">
                                @if (Route::currentRouteName() === 'admin.sale.report')
                                        <span class="badge bg-primary">Sale</span>
                                    @else
                                        Sale
                                    @endif</a>
                               </li>
                            <li class="nav-item"><a href="{{route('admin.sale-return.reports')}}" class="nav-link         
                                {{Route::currentRouteName() === 'admin.sale-return.reports' ? 'active' : '' }}">
                                @if (Route::currentRouteName() === 'admin.sale-return.reports')
                                        <span class="badge bg-primary">Sale Return</span>
                                    @else
                                        Sale Return
                                    @endif</a>
                               </li>
                            <li class="nav-item"><a href="#" class="nav-link">Stock</a></li>
                        </ul>
                    </div>

                    <div class="d-flex align-items-center ms-3 position-relative">
                        <select id="date-range" class="form-select">
                            <option value="today">Today</option>
                            <option value="this_week">This Week</option>
                            <option value="last_week">Last Week</option>
                            <option value="this_month">This Month</option>
                            <option value="last_month">Last Month</option>
                            <option value="custom">Custom Range</option>
                        </select>
                        <span class="mdi mdi-filter-menu text-white ms-2"></span>

                        <div id="custom-date-range" class="d-flex align-items-center ms-3 d-none">
                            <input type="date" id="start-date" name="start_date" class="form-control me-2">
                            <input type="date" id="end-date" name="end_date" class="form-control me-2">

                            <button id="search-date-range" type="button"
                                class="btn btn-primary d-flex align-items-center">
                                <span class="mdi mdi-magnify me-1"></span> Search
                            </button>
                        </div>

                    </div>

                </div>
            </nav>

            <!-- DataTable -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Warehouse</th>
                                <th>Product</th>
                                <th>Stock</th>
                                <th>Unit Price</th>
                                <th>Status</th>
                                <th>Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($returnSales as $key => $returnSale)
                                @foreach ($returnSale->saleReturnItems as $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $returnSale->date }}</td>
                                        <td>{{ $returnSale->customer->name ?? 'N/A' }}</td>
                                        <td>{{ $returnSale->warehouse->name ?? 'N/A' }}</td>
                                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                                        <td>{{ $item->quantity ?? 'N/A' }}</td>
                                        <td>₹{{ $item->net_unit_cost ?? 'N/A' }}</td>
                                        <td>{{ $returnSale->status ?? 'N/A' }}</td>
                                        <td>₹{{ $returnSale->grand_total ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
  <script>
        function fetchFilteredData(filterType, startDate = null, endDate = null) {


            $.ajax({
                url: '{{ route('admin.sale-return.filter') }}',
                method: 'GET',
                data: {
                    filter: filterType,
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    let table = $('#example').DataTable();
                    table.clear().draw();

                    response.data.forEach(function(row, index) {
                        table.row.add([
                            index + 1,
                            row.date,
                            row.customer,
                            row.warehouse,
                            row.product,
                            row.quantity,
                            `₹${row.net_unit_cost}`,
                            row.status,
                            `₹${row.grand_total}`
                        ]).draw(false);
                    });
                },
                error: function() {
                    alert('Failed to load data.');
                },
                complete: function() {
                    $('#ajax-loader').hide();
                }
            });
        }

        $(document).ready(function() {
            $('#example').DataTable();

            const defaultFilter = $('#date-range').val();
            fetchFilteredData(defaultFilter);

            $('#date-range').on('change', function() {
                let value = $(this).val();

                if (value === 'custom') {
                    $('#custom-date-range').removeClass('d-none');
                } else {
                    $('#custom-date-range').addClass('d-none');
                    fetchFilteredData(value);
                }
            });

            $('#search-date-range').on('click', function() {
                let startDate = $('#start-date').val();
                let endDate = $('#end-date').val();
                if (startDate && endDate) {
                    fetchFilteredData('custom', startDate, endDate);
                }
            });
        });
    </script>
@endpush
