@extends('layouts.dashboardlayout')
@section('title', 'Accessory List')
@section('breadcrumb1', 'Inventory Management')
@section('breadcrumb', 'Accessory List')
@section('pageTitle', 'Accessory List')
@section('content')

    <div class="container">
        <!-- Filters for Accessory List -->
        <form method="GET" action="{{ route('accessories.index') }}">
            <div class="row gy-2 gx-2 align-items-center">

                <!-- Showroom Filter -->
                <div class="col-auto">
                    <div class="mb-2">
                        <label for="showroom_id" class="form-label">Showroom</label>
                        <select id="showroom_id" name="showroom_id" class="form-select">
                            <option value="">Select Showroom...</option>
                            <!-- Populate with showroom options -->
                            @foreach ($showrooms as $showroom)
                                <option value="{{ $showroom->id }}"
                                    {{ request('showroom_id') == $showroom->id ? 'selected' : '' }}>
                                    {{ $showroom->shr_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Apply Filters Button -->
                <div class="col-auto">
                    <div class="mb-0">
                        <label class="form-label"></label>
                        <button type="submit" class="btn btn-primary">Apply Filter</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Accessory List Table -->
        <div class="table-responsive mt-3">
            <table id="accessoryTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Dealer</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accessories as $accessory)
                        <tr>
                            <td>{{ $accessory->name }}</td>
                            <td>{{ $accessory->description }}</td>
                            <td>${{ number_format($accessory->price, 2) }}</td>
                            <td>{{ $accessory->showroom ? $accessory->showroom->shr_name : '-' }}</td>
                            {{-- <td><a href="{{ route('accessories.show', $accessory->id) }}" class="btn btn-info">View
                                    Details</a></td> --}}
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
            $('#accessoryTable').DataTable({
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
