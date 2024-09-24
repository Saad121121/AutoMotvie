@extends('layouts.dashboardlayout')

@section('title', 'Support Ticket Management')
@section('breadcrumb1', 'Support')
@section('breadcrumb', 'Support Tickets')
@section('pageTitle', 'Support Ticket Management')

@section('content')
<div class="body-content">
    <!-- Button to Open Modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">Open Support
        Ticket</button>

    <!-- Large Modal -->
    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Create Support Ticket</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <!-- Support Ticket Form -->
                    <form action="#">
                        @csrf
                        <div class="mb-3">
                            <label for="ticket_title" class="form-label">Ticket Title</label>
                            <input type="text" id="ticket_title" name="ticket_title" class="form-control"
                                placeholder="Enter Ticket Title" required>
                        </div>
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input type="text" id="customer_name" name="customer_name" class="form-control"
                                placeholder="Enter Customer Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter Email Address" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" id="phone_number" name="phone_number" class="form-control"
                                placeholder="Enter Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <label for="ticket_description" class="form-label">Ticket Description</label>
                            <textarea id="ticket_description" name="ticket_description" class="form-control" rows="4"
                                placeholder="Provide details about the issue" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Ticket</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Static Tickets Table -->
    <h3 class="mt-4 mb-4">Submitted Tickets</h3>
    <table class="table table-striped table-centered mb-0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ticket Title</th>
                <th>Customer Name</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Description</th>
                <th>Technician</th>
                <th>Dealer</th>
                <th>Status</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            <!-- Static Data (for demo purposes) -->
            <tr>
                <td>1</td>
                <td>Login Issue</td>
                <td>John Doe</td>
                <td>johndoe@example.com</td>
                <td>123-456-7890</td>
                <td>Unable to log in to the system.</td>
                <td>Alan Walker</td>
                <td>Freedom Auto Center</td>
                <td>Pending</td>
                <td>2024-08-31 10:00:00</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Payment Failure</td>
                <td>Jane Smith</td>
                <td>janesmith@example.com</td>
                <td>098-765-4321</td>
                <td>Payment failed during checkout.</td>
                <td>Ronaldo Walker</td>
                <td>Freedom Auto Center</td>
                <td>Resolved</td>
                <td>2024-08-31 11:00:00</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    // Any additional JavaScript for handling form interactions or UI enhancements
</script>
@endpush