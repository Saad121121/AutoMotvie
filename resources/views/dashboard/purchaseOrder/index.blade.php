@extends('layouts.dashboardlayout')
@section('title', 'Purchase Order')
@section('breadcrumb1', 'Inventory Management')
@section('breadcrumb', 'Purchase Order')
@section('pageTitle', 'Purchase Order')
@section('content')

    <div class="container">
        <!-- Create Supplier Button -->
        <!-- Large modal Button-->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">Create
            Purchase Order</button>


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
        {{-- {{ dd($purchaseOrders->toArray()) }}    --}}
        <div class="table-responsive">
            <table id="partTable" class="table table-striped">
                <thead>

                    <tr>
                        <th>S.No</th>
                        <th>PO Number</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Parts</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchaseOrders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->po }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>items</td>
                            <td class="table-action">
                                {{-- <a href="{{ route('parts.edit', $->id) }}" class="action-icon"> <i
                                        class="mdi mdi-pencil"></i></a>
                                <form action="{{ route('parts.destroy', $->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-icon btn btn-link"
                                        onclick="return confirm('Are you sure you want to delete this part?');"> <i
                                            class="mdi mdi-delete"></i></button>
                                </form>  --}}
                                @if (Auth::user()->role_id == 5)
                                    <a href="{{ route('purchase-orders.detail', $order->id) }}" class="action-icon">
                                        <i class="mdi mdi-eye-outline"></i>
                                    </a>
                                @endif
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
                    <h4 class="modal-title" id="myLargeModalLabel">Purchase Order</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('purchase-orders.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="po" class="form-label">PO Number</label>
                            <input type="text" name="po" id="po" class="form-control" required readonly>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="showroom_id" class="form-label">Showroom</label>
                            <select name="showroom_id" id="showroom_id" class="form-select" required>
                                <option value="">Select a showroom...</option>
                                @foreach ($showrooms as $showroom)
                                    <option value="{{ $showroom->id }}">{{ $showroom->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="mb-3">
                            <label for="order_date" class="form-label">Order Date</label>
                            <input type="date" name="order_date" id="order_date" class="form-control" required
                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                        </div>

                        <h4>Order Items</h4>
                        <table class="table" id="order-items-table">
                            <thead>
                                <tr>
                                    <th>Part</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="order-items-body">
                                {{-- <tr>
                                    <td>
                                        <select name="parts[]" class="form-select" required>
                                            <option value="">Select a part...</option>
                                            @foreach ($parts as $part)
                                                <option value="{{ $part->id }}" data-price="{{ $part->unit_price }}">
                                                    {{ $part->part_name }} ({{ $part->part_number }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantities[]" class="form-control" min="1"
                                            required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove-part-btn">Remove</button>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>

                        <div class="mb-3">
                            <label for="total_amount" class="form-label">Total Amount</label>
                            <input type="text" name="total_amount" id="total_amount" class="form-control" readonly>
                        </div>

                        <button type="button" id="add-part-btn" class="btn btn-info">Add Part</button>
                        <button type="submit" class="btn btn-primary">Save Purchase Order</button>
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
            fetch("{{ route('generate.po.number') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('po').value = data.part_number;
                })
                .catch(error => console.error('Error fetching po number:', error));
        });
        document.getElementById('add-part-btn').addEventListener('click', function() {
            var tableBody = document.getElementById('order-items-body');
            var newRow = `
        <tr>
            <td>
                <select name="parts[]" class="form-select part-select" required>
                    <option value="">Select a part...</option>
                    @foreach ($parts as $part)
                        <option value="{{ $part->id }}" data-price="{{ $part->unit_price }}">{{ $part->part_name }} ({{ $part->part_number }})</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="quantities[]" class="form-control quantity-input" min="1" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger remove-part-btn">Remove</button>
            </td>
        </tr>`;
            tableBody.insertAdjacentHTML('beforeend', newRow);

            // Attach events to new rows
            attachRemoveEvent();
            attachChangeEvent();
        });

        // Attach remove event to remove buttons
        function attachRemoveEvent() {
            document.querySelectorAll('.remove-part-btn').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('tr').remove();
                    updateTotalAmount(); // Update total amount when a row is removed
                });
            });
        }

        // Attach change event to select and input fields
        function attachChangeEvent() {
            document.querySelectorAll('.part-select, .quantity-input').forEach(element => {
                element.addEventListener('change', updateTotalAmount);
            });
        }

        // Update total amount based on selected parts and quantities
        function updateTotalAmount() {
            let totalAmount = 0;
            document.querySelectorAll('#order-items-body tr').forEach(row => {
                const select = row.querySelector('.part-select');
                const quantityInput = row.querySelector('.quantity-input');

                const unitPrice = parseFloat(select.options[select.selectedIndex].getAttribute('data-price')) || 0;
                const quantity = parseFloat(quantityInput.value) || 0;

                totalAmount += unitPrice * quantity;
            });
            document.getElementById('total_amount').value = totalAmount.toFixed(2);
        }

        // Initial setup
        attachRemoveEvent();
        attachChangeEvent();
    </script>
@endpush
