@extends('layouts.dashboardlayout')
@section('title', 'Purchase Order Details')
@section('breadcrumb1', 'Purchase Management')
@section('breadcrumb', 'PO Details')
@section('pageTitle', 'Purchase Order Details')
@section('content')

    <div class="container">
        <!-- PO Details -->
        <!-- Suppliers Table -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success - </strong> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Error - </strong> {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 id="poTitle">Purchase Order #{{ $purchaseOrder->po }}</h4>
            </div>
            <div class="card-body">
                <p><strong>Date Created:</strong> <span id="poDateCreated">{{ $purchaseOrder->order_date }}</span></p>
                <p><strong>Status:</strong> <span id="poStatus">{{ ucfirst($purchaseOrder->status) }}</span></p>
                <p><strong>Total Amount:</strong> <span id="poTotalQuantity">{{ $purchaseOrder->total_amount }}</span></p>
                <p><strong>Total Quantity:</strong> <span
                        id="poTotalQuantity">{{ $purchaseOrder->items->sum('quantity') ?? 0 }}</span></p>
                <p><strong>Received Quantity:</strong> <span
                        id="poReceivedQuantity">{{ $purchaseOrder->received_quantity ?? '0' }}</span></p>

                <!-- Update Status Form -->
                <div class="mt-3">

                    <button type="submit" class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#top-modal">Update
                        Status</button>

                </div>

                <!-- Add Received Quantity Form -->
                <div class="mt-3">
                    <h5>Add Received Quantity</h5>
                    <form id="addReceivedQuantityForm" method="POST"
                        action="{{ route('purchase-orders.add-quantity', $purchaseOrder->id) }}">
                        @csrf
                        <div class="mb-2">
                            <label for="received_quantity" class="form-label">Received Quantity</label>
                            @if ($purchaseOrder->received_quantity != '' || $purchaseOrder->received_quantity)
                                <input type="number" id="received_quantity" name="received_quantity"
                                    value="{{ $purchaseOrder->received_quantity }}" class="form-control" min="1"
                                    readonly>
                            @else
                                <input type="number" id="received_quantity" name="received_quantity" class="form-control"
                                    min="1" required>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">Add Quantity</button>
                    </form>
                </div>

                <!-- Buttons for Actions -->
                <div class="mt-3">
                    <button type="button" class="btn btn-warning" onclick="showEditSuccess()">Edit PO</button>
                    <button type="button" class="btn btn-danger" onclick="cancelPO()">Cancel PO</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Modal -->
    <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-top">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="topModalLabel">Update Status</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('purchase-orders.update-status', $purchaseOrder->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="modal-status" class="form-label">Status</label>
                            <select id="modal-status" name="status" class="form-select">
                                <option value="pending" {{ $purchaseOrder->status === 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="shipped" {{ $purchaseOrder->status === 'shipped' ? 'selected' : '' }}>
                                    Shipped</option>
                                <option value="delivered" {{ $purchaseOrder->status === 'delivered' ? 'selected' : '' }}>
                                    Delivered</option>
                                <option value="cancelled" {{ $purchaseOrder->status === 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@push('scripts')
    <script>
        function showEditSuccess() {
            alert('Purchase Order has been successfully edited!');
        }

        function cancelPO() {
            // Cancel the PO in your backend
            alert('Purchase Order has been cancelled.');
        }
    </script>
@endpush
