@extends('layouts.dashboardlayout')
@section('title', 'Suppliers')
@section('breadcrumb1', 'Supplier Management')
@section('breadcrumb', 'Suppliers')
@section('pageTitle', 'Suppliers')
@section('content')

    <div class="container">
        <!-- Create Supplier Button -->
        <!-- Large modal Button-->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">Create
            Supplier</button>


        <!-- Suppliers Table -->
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
        <div class="table-responsive">
            <table id="supplierTable" class="table table-striped table-centered mb-0">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Contact Info</th>
                        <th>Lead Time</th>
                        <th>Payment Terms</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $index => $supplier)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->contact_info }}</td>
                            <td>{{ $supplier->lead_time }}</td>
                            <td>{{ $supplier->payment_terms }}</td>
                            <td class="table-action">
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="action-icon"> <i
                                        class="mdi mdi-pencil"></i></a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-icon btn btn-link"
                                        onclick="return confirm('Are you sure you want to delete this supplier?');"> <i
                                            class="mdi mdi-delete"></i></button>
                                </form>
                                <a href="{{ route('view_supplier_page_detail') }}" class="action-icon"> <i
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
                    <form action="{{ route('suppliers.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Supplier Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Supplier Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_info" class="form-label">Contact Info</label>
                            <textarea id="contact_info" name="contact_info" class="form-control" placeholder="Contact Info" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="lead_time" class="form-label">Lead Time (in days)</label>
                            <input type="number" id="lead_time" name="lead_time" class="form-control"
                                placeholder="Lead Time" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_terms" class="form-label">Payment Terms</label>
                            <textarea id="payment_terms" name="payment_terms" class="form-control" placeholder="Payment Terms" required></textarea>
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
            $('#supplierTable').DataTable({
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
