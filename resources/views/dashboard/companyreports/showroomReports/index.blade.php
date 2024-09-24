@extends('layouts.dashboardlayout')
@section('title', 'Dealer Reports')
@section('breadcrumb1', 'Company')
@section('breadcrumb', 'Dealer Reports')
@section('pageTitle', 'Dealer Reports')
@section('content')

    <div class="body-content">


        <div class="table-responsive">
            <table id="showroomTable" class="table table-striped table-centered mb-0">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Manager</th>
                        <th>Created_at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($showrooms as $index => $showroom)
                        <tr>
                            {{-- {{ dd($showroom->id) }} --}}
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $showroom->shr_name ?? '-' }}</td>
                            <td>{{ $showroom->shr_contact_number ?? '-' }}</td>
                            <td>{{ $showroom->shr_contact_email ?? '-' }}</td>
                            <td>{{ $showroom->shr_location ?? '-' }}</td>
                            <td>{{ $showroom->manager ? $showroom->manager->name : '-' }}</td>
                            <td>{{ $showroom->created_at ? \Carbon\Carbon::parse($showroom->created_at)->format('j-M-Y') : '-' }}
                            </td>
                            <td class="table-action">

                                <a href="{{ route('dealer-service-report', ['id' => $showroom->id]) }}" class="action-icon">
                                    <i class="mdi mdi-eye"></i>
                                </a>

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
            $('#showroomTable').DataTable({
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
