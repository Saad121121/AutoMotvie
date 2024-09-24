@extends('layouts.dashboardlayout')
@section('title', 'Showroom')
@section('breadcrumb1', 'Dealer Management')
@section('breadcrumb', 'Dealer')
@section('pageTitle', 'Dealer')
@section('content')

<div class="body-content">
    <!-- Create Role Button -->


    <!-- User Table -->
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

    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="heading-tittle">Dealer List</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">Add Dealer</button>
    </div>
    <!-- <div class="table-responsive mt-5 mb-5">
        <h2 class="heading-tittle">Dealer Orders</h2>
        <table id="showroomTable" class="table table-striped table-centered mb-0">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Order Date</th>
                    <th>Part Number</th>
                    <th>Quantity Ordered</th>
                    <th>Order Value</th>
                    <th>Delivery Date</th>
                    <th>Order Status</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>2-Sep-2024</td>
                    <td>32456985</td>
                    <td>500</td>
                    <td>$20000</td>
                    <td>10-Sep-2024</td>
                    <td>Approved</td>
                    <td>Cash</td>
                </tr>
                <tr>
                    <td>02</td>
                    <td>20-Aug-2024</td>
                    <td>72619735</td>
                    <td>200</td>
                    <td>$14000</td>
                    <td>28-Aug-2024</td>
                    <td>Pending</td>
                    <td>Card</td>
                </tr>
                <tr>
                    <td>03</td>
                    <td>10-Aug-2024</td>
                    <td>19486542</td>
                    <td>600</td>
                    <td>$24000</td>
                    <td>16-Aug-2024</td>
                    <td>Approved</td>
                    <td>Bank Transfer</td>
                </tr>
            </tbody>
        </table>
    </div> -->
</div>


<div class="table-responsive  mb-5">
    <table id="showroomTable" class="table table-striped table-centered mt-2">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Dealer Name</th>
                <th>Contact No.</th>
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
                    <a href="#" class="action-icon"
                        onclick="showUpdateOwnerModal({{ $showroom->id }}, '{{ $showroom->shr_name }}', '{{ $showroom->shr_contact_number }}', '{{ $showroom->shr_contact_email }}', '{{ $showroom->shr_location }}')">
                        <i class="mdi mdi-pencil"></i>
                    </a>
                    <a href="#" class="action-icon" onclick="deleteOwner({{ $showroom->id }})">
                        <i class="mdi mdi-delete"></i>
                    </a>
                    <a href="{{ route('dealer-dashboard', ['id' => $showroom->id]) }}" class="action-icon">
                        <i class="mdi mdi-eye"></i>
                    </a>
                    <a href="{{ route('sales-performance') }}" class="action-icon">
                        <i class="dripicons-graph-line"></i>
                    </a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
<!-- Create user Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ownerModalLabel">Add Dealer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Owner Form -->
                <form action="{{ route('showroom.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="cstm-input-style">
                                <label>Dealer Id:</label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="cstm-input-style">
                                <label>Dealer Name:</label>
                                <input type="text" id="shr_name" name="shr_name" placeholder="John Doe"
                                    value="{{ old('shr_name') }}" required>
                                @error('shr_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="cstm-input-style">
                                <label>Address:</label>
                                <!-- <input type="text"> -->
                                <input id="shr_location" name="shr_location" placeholder="123 Main St, Apt 4B"
                                    required>{{ old('shr_location') }}</input>
                                @error('shr_location')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="cstm-input-style">
                                <label>City:</label>
                                <input type="text" placeholder="John Doe">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="cstm-input-style">
                                <label>State:</label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="cstm-input-style">
                                <label>Country:</label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="cstm-input-style">
                                <label>Zip Code:</label>
                                <input type="text" placeholder="75300" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="cstm-input-style">
                                <label>Phone No:</label>
                                <!-- <input type="phone" required> -->
                                <input type="text" id="shr_contact_number" name="shr_contact_number"
                                    placeholder="03132458754" value="{{ old('shr_contact_number') }}" required>
                                @error('shr_contact_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="cstm-input-style">
                                <label>Email Address:</label>
                                <!-- <input type="email" placeholder="text@email.com" required> -->
                                <input type="email" id="shr_contact_email" name="shr_contact_email"
                                    placeholder="John@gmail.com" value="{{ old('shr_contact_email') }}">
                                @error('shr_contact_email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="cstm-input-style">
                                <label>Website:</label>
                                <input type="email" placeholder="text@email.com">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="cstm-input-style">
                                <label>Dealer Type:</label>
                                <select>
                                    <option value="0">Choose the type</option>
                                    <option value="1">Wholesale</option>
                                    <option value="2">Retail</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-end"> <button type="submit" class="btn btn-primary">Create Dealer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editShowroomModalLabel">Edit Dealer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Showroom Form -->
                <form id="editShowroomForm" method="POST" action="{{ route('showroom.update', ['id' => 'id']) }}">
                    @csrf
                    @method('PUT')

                    <!-- Hidden ID Field -->
                    <input type="hidden" id="edit_showroom_id" name="showroom_id">

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="edit_shr_name" class="form-label">Name</label>
                        <input type="text" id="edit_shr_name" name="shr_name" class="form-control"
                            placeholder="Showroom Name" required>
                        @error('shr_name')
                        <div id="edit_shr_nameError" class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Contact Number -->
                    <div class="mb-3">
                        <label for="edit_shr_contact_number" class="form-label">Contact Number</label>
                        <input type="text" id="edit_shr_contact_number" name="shr_contact_number"
                            class="form-control" placeholder="03132458754 or +923132566985 or 923135688954" required>
                        @error('shr_contact_number')
                        <div id="edit_shr_contact_numberError" class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="edit_shr_contact_email" class="form-label">Email</label>
                        <input type="email" id="edit_shr_contact_email" name="shr_contact_email"
                            class="form-control" placeholder="showroom@example.com">
                        @error('shr_contact_email')
                        <div id="edit_shr_contact_emailError" class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label for="edit_shr_location" class="form-label">Address</label>
                        <textarea id="edit_shr_location" name="shr_location" class="form-control" rows="3"
                            placeholder="123 Main St, Apt 4B" required></textarea>
                        @error('shr_location')
                        <div id="edit_shr_locationError" class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
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
    // Function to show the update role modal with pre-filled data
    function showUpdateOwnerModal(id, name, contactNumber, email, address) {
        // Set form values
        document.getElementById('edit_showroom_id').value = id;
        document.getElementById('edit_shr_name').value = name;
        document.getElementById('edit_shr_contact_number').value = contactNumber;
        document.getElementById('edit_shr_contact_email').value = email;
        document.getElementById('edit_shr_location').value = address;

        // Show the modal
        var editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
        editUserModal.show();
    }




    // For deleting a user
    function deleteOwner(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/showroom/${id}`, // Updated URL to match the owner route
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // Ensure CSRF token is included
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'The manager has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to reflect changes
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the manager.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
@endpush