@extends('layouts.dashboardlayout')
@section('title', 'Trade-In Requests')
@section('breadcrumb1', 'Trade-In Management')
@section('breadcrumb', 'Trade-In Requests')
@section('pageTitle', 'Trade-In Requests')

@section('content')
    <div class="container">
        <!-- Button to Create New Trade-In Request -->
        <div class="mb-3">
            <a href="{{ route('tradein.create') }}" class="btn btn-primary">Create New Trade-In Request</a>
        </div>

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
        <!-- Trade-In Requests Table -->
        <div class="table-responsive mt-3">
            <table id="tradeInTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Full Name</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Current Market Value</th>
                        <th>Preferred Contact Method</th>
                        <th>Trade-In Timing</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tradeInRequests as $index => $tradeIn)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $tradeIn->full_name }}</td>
                            <td>{{ $tradeIn->make }}</td>
                            <td>{{ $tradeIn->model }}</td>
                            <td>{{ $tradeIn->year }}</td>
                            <td>${{ number_format($tradeIn->current_market_value, 2) }}</td>
                            <td>{{ $tradeIn->preferred_contact_method }}</td>
                            <td>{{ \Carbon\Carbon::parse($tradeIn->trade_in_timing)->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('tradein.show', $tradeIn->id) }}" class="btn btn-info">View Details</a>
                                <!-- Add any other actions you need -->
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
            $('#tradeInTable').DataTable({
                // DataTables configuration
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
