@extends('layouts.dashboardlayout')
@section('title', 'Parts')
@section('breadcrumb1', 'Inventory Management')
@section('breadcrumb', 'Parts')
@section('pageTitle', 'Parts')
@section('content')

    <div class="container">
        {{-- FIlter --}}
        <form method="POST" action="#">
            @csrf
            <div class="row gy-2 gx-2 align-items-center">

                <div class="col-auto">
                    <div class="mb-2">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id" name="category_id" class="form-select">
                            <option value="" selected>Select Category...</option>
                            <option value="1">Engine Component</option>
                            <option value="2">Fuel System</option>
                            <option value="3">Exhaust System</option>
                            <option value="4">Beaking System</option>
                            <!-- Add more categories as needed -->
                        </select>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="mb-2">
                        <label for="location_id" class="form-label">Stock Level By Parts</label>
                        <select id="location_id" name="location_id" class="form-select">
                            <option value="" selected>Select Parts...</option>
                            <option value="1">Fuel Pump</option>
                            <option value="2">Break Pads</option>
                            <option value="3">Pistons</option>
                            <option value="4">Muffler</option>
                            <option value="5">Crankshaft</option>
                            <option value="6">Germany</option>
                            <option value="7">Japan</option>
                            <option value="8">France</option>
                        </select>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="mb-2">
                        <label for="stock_level_id" class="form-label">Stock Level</label>
                        <select id="stock_level_id" name="stock_level_id" class="form-select">
                            <option value="" selected>Select Stock Level...</option>
                            <option value="1">In Stock</option>
                            <option value="2">Low Stock</option>
                            <option value="3">Out of Stock</option>
                        </select>
                    </div>
                </div>




                <div class="col-auto">
                    <div class="mb-0">
                        <label for="showroom_id" class="form-label"></label>
                        <button type="submit" class="btn btn-primary mb-2 form-select">Apply Filter</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Create Supplier Button -->
        <!-- Large modal Button-->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">Create
            Part</button>


        <!-- Suppliers Table -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
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

        <div class="table-responsive">
            <table id="partTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Part Number</th>
                        <th>Part Name</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Supplier</th>
                        <th>Stock Level</th>
                        <th>Reorder Point</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parts as $index => $part)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $part->part_number }}</td>
                            <td>{{ $part->part_name }}</td>
                            <td>{{ $part->category }}</td>
                            <td>{{ $part->location }}</td>
                            <td>Supplier</td>
                            <td>{{ $part->stock_level }}</td>
                            <td>{{ $part->reorder_point }}</td>
                            <td class="table-action">
                                <a href="{{ route('parts.edit', $part->id) }}" class="action-icon"> <i
                                        class="mdi mdi-pencil"></i></a>
                                <form action="{{ route('parts.destroy', $part->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-icon btn btn-link"
                                        onclick="return confirm('Are you sure you want to delete this part?');"> <i
                                            class="mdi mdi-delete"></i></button>

                                </form>
                                <a href="{{ route('view_part_page_detail') }}" class="action-icon"> <i
                                        class="mdi mdi-eye-outline"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Create Modal --}}
    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('parts.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="part_number" class="form-label">Part Number</label>
                            <input type="text" name="part_number" id="part_number" class="form-control" required
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="part_name" class="form-label">Part Name</label>
                            <input type="text" name="part_name" id="part_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select id="category" name="category" class="form-select" required>
                                <option value="">Select a category</option>
                                <option value="Vehicle Parts">Vehicle Parts</option>
                                <option value="Showroom Supplies">Showroom Supplies</option>
                                <option value="Accessories">Accessories</option>
                                <option value="Tools">Tools</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" name="location" id="location" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="supplier_id" class="form-label">Supplier</label>
                            <select name="supplier_id" id="supplier_id" class="form-select" required>
                                <!-- Assuming you have suppliers loaded into the view -->
                                <option value="" selected>Select Supplier...</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="stock_level" class="form-label">Stock Level</label>
                            <input type="number" name="stock_level" id="stock_level" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="reorder_point" class="form-label">Reorder Point</label>
                            <input type="number" name="reorder_point" id="reorder_point" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#partTable').DataTable({
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
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch the unique part number when the page loads
            fetch("{{ route('generate.part.number') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('part_number').value = data.part_number;
                })
                .catch(error => console.error('Error fetching part number:', error));
        });
    </script>
@endpush
