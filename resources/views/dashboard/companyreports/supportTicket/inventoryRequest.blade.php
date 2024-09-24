@extends('layouts.dashboardlayout')

@section('title', 'Inventory Request Ticket')
@section('breadcrumb1', 'Inventory Management')
@section('breadcrumb', 'Inventory Request Ticket')
@section('pageTitle', 'Inventory Request Ticket')

@section('content')
    <div class="body-content">
        <!-- Button to Open Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">Open Inventory
            Request</button>

        <!-- Large Modal -->
        <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Request Inventory</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Inventory Request Form -->
                        <form action="#">
                            @csrf
                            <div class="mb-3">
                                <label for="showroom_name" class="form-label">Showroom Name</label>
                                <input type="text" id="showroom_name" name="showroom_name" class="form-control"
                                    placeholder="Enter Showroom Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact_person" class="form-label">Contact Person</label>
                                <input type="text" id="contact_person" name="contact_person" class="form-control"
                                    placeholder="Enter Contact Person Name" required>
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
                                <label for="inventory_details" class="form-label">Inventory Details</label>
                                <textarea id="inventory_details" name="inventory_details" class="form-control" rows="4"
                                    placeholder="Provide details about the inventory request" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Static Requests Table -->
        <h3 class="mt-4 mb-4">Submitted Requests</h3>
        <table class="table table-striped table-centered mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dealer Name</th>
                    <th>Contact Person</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Inventory Details</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                <!-- Static Data (for demo purposes) -->
                <tr>
                    <td>1</td>
                    <td>ABC Showroom</td>
                    <td>John Doe</td>
                    <td>johndoe@example.com</td>
                    <td>123-456-7890</td>
                    <td>Requesting 5 units of Model XYZ.</td>
                    <td>2024-08-31 10:00:00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>XYZ Showroom</td>
                    <td>Jane Smith</td>
                    <td>janesmith@example.com</td>
                    <td>098-765-4321</td>
                    <td>Requesting 10 units of Model ABC.</td>
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
