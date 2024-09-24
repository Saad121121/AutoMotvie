@extends('layouts.dashboardlayout')
@section('title', 'Vehicle Sales')
@section('breadcrumb1', 'Vehicle Management')
@section('breadcrumb', 'Vehicle Sales')
@section('pageTitle', 'Vehicle Sales')
@section('content')

    <div class="container">
        <!-- Create Vehicle Sale Button -->
        <a href="{{ route('sales.create') }}" class="btn btn-info">Add Vehicle Sale</a>

        <!-- Success and Error Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success - </strong> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
                <strong>Error - </strong> {{ session('error') }}
            </div>
        @endif

        <!-- Vehicle Sales Data Table -->
        <div class="table-responsive">
            <table id="vehicleSalesTable" class="table table-striped table-centered mb-0">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Customer ID</th>
                        <th>Vehicle Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>VIN</th>
                        <th>Total Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $index => $sale)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sale->customer_id }}</td>
                            <td>{{ $sale->make }}</td>
                            <td>{{ $sale->model }}</td>
                            <td>{{ $sale->year }}</td>
                            <td>{{ $sale->vin }}</td>
                            <td>{{ $sale->total_price }}</td>
                            <td class="table-action">
                                <a href="{{ route('sales.edit', $sale->id) }}" class="action-icon"> <i
                                        class="mdi mdi-pencil"></i></a>
                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-icon btn btn-link"
                                        onclick="return confirm('Are you sure you want to delete this sale?');"> <i
                                            class="mdi mdi-delete"></i></button>
                                </form>
                                <a href="{{ route('sales.show', $sale->id) }}" class="action-icon"> <i
                                        class="mdi mdi-eye-outline"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#vehicleSalesTable').DataTable({
                paging: true, // Enable pagination
                searching: true, // Enable search
                ordering: true, // Enable sorting
                lengthChange: false, // Disable page length change
                info: true, // Show table information
                pageLength: 15,
                language: {
                    searchPlaceholder: "Search records...", // Placeholder text for search
                    paginate: {
                        previous: "Prev",
                        next: "Next"
                    },
                    info: "Showing _START_ to _END_ of _TOTAL_ entries", // Info text
                    infoEmpty: "No entries found", // Info text when no entries
                    infoFiltered: "(filtered from _MAX_ total entries)"
                }
            });
        });
    </script>
@endpush
