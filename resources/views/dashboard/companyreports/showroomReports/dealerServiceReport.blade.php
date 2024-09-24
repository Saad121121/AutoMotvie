@extends('layouts.dashboardlayout')
@section('title', 'Showroom Service Report')
@section('breadcrumb1', 'Showroom')
@section('breadcrumb', 'Service Report')
@section('pageTitle', 'Showroom Service Report')
@section('content')

    <div class="body-content">
        <a href="{{ route('generate-vehicle-report', ['showroomId' => $showroomId]) }}" class="btn btn-primary">Generate PDF
            Report</a>
        <div class="table-responsive">
            <table id="showroomTable" class="table table-centered table-nowrap table-hover mb-0">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>VIN</th>
                        <th>Services</th>
                        <th>Owner</th>
                        <th>Total Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $index => $vehicle)
                        <tr>
                            <td>{{ $vehicles->firstItem() + $index }}</td>
                            <td>{{ $vehicle->vin ?? '-' }}</td>
                            <td>{{ $vehicle->service_count ?? '-' }}</td>
                            <td>{{ $vehicle->owner ? $vehicle->owner->name : '-' }}</td>
                            <td>Rs{{ $vehicle->total_estimated_cost ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="pagination mt-4">
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#showroomTable').DataTable({
                // DataTables configuration
                paging: true, // Enable pagination
                searching: true, // Enable search
                ordering: true, // Enable sorting
                lengthChange: false, // Disable page length change
                info: true, // Show table information
                pageLength: 50,
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
