@extends('layouts.dashboardlayout')
@section('title', 'Users Activity Dashboard')
@section('breadcrumb1', 'User Management')
@section('breadcrumb', 'Users Activity Dashboard')
@section('pageTitle', 'Users Activity Dashboard')
@section('content')

    <div class="container">
        <!-- Table Section -->
        <div class="table-responsive mb-4">
            <table id="userActivityTable" class="table table-striped table-centered mb-0">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>Showroom Name</th>
                        <th>Action</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usersActivity as $index => $usersA)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $usersA->user->name ?? '-' }}</td>
                            <td>{{ $usersA->showroom->shr_name ?? '-' }}</td>
                            <td>{{ $usersA->action ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($usersA->created_at)->format('d-M-Y g:i A') ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Graphs Section -->
        <div class="row">
            <div class="col-md-6">
                <canvas id="actionsByUserChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="actionsByDateChart"></canvas>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#userActivityTable').DataTable({
                // DataTables configuration
                paging: true,
                searching: true,
                ordering: true,
                lengthChange: false,
                info: true,
                pageLength: 15,
                language: {
                    searchPlaceholder: "Search records...",
                    paginate: {
                        previous: "Prev",
                        next: "Next"
                    },
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                }
            });

            // Data for charts
            var actionsByUser = @json($actionsByUser->pluck('total_actions'));
            var userNames = @json($actionsByUser->pluck('user.name'));

            var actionsByDate = @json($actionsByDate->pluck('total_actions'));
            var dates = @json($actionsByDate->pluck('date'));

            // Chart for Actions by User
            var ctx1 = document.getElementById('actionsByUserChart').getContext('2d');
            var actionsByUserChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: userNames,
                    datasets: [{
                        label: 'Actions by User',
                        data: actionsByUser,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Chart for Actions by Date
            var ctx2 = document.getElementById('actionsByDateChart').getContext('2d');
            var actionsByDateChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Actions by Date',
                        data: actionsByDate,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush
