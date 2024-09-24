@extends('layouts.dashboardlayout')
@section('title', 'Transaction List')
@section('breadcrumb1', 'Inventory Management')
@section('breadcrumb', 'Transaction List')
@section('pageTitle', 'Transaction List')
@section('content')

    <div class="container">
        <!-- Filters for Transaction List -->
        <form method="GET" action="#">
            <div class="row gy-2 gx-2 align-items-center">

                <!-- Date Range Filter -->
                <div class="col-auto">
                    <div class="mb-2">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form-control">
                    </div>
                </div>

                <div class="col-auto">
                    <div class="mb-2">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="form-control">
                    </div>
                </div>

                <!-- Part Number Filter -->
                <div class="col-auto">
                    <div class="mb-2">
                        <label for="part_number" class="form-label">Part Number</label>
                        <input type="text" id="part_number" name="part_number" class="form-control"
                            placeholder="Enter part number">
                    </div>
                </div>

                <!-- Transaction Type Filter -->
                <div class="col-auto">
                    <div class="mb-2">
                        <label for="transaction_type" class="form-label">Transaction Type</label>
                        <select id="transaction_type" name="transaction_type" class="form-select">
                            <option value="">Select Transaction Type...</option>
                            <option value="inbound">Inbound</option>
                            <option value="outbound">Outbound</option>
                        </select>
                    </div>
                </div>

                <!-- Apply Filters Button -->
                <div class="col-auto">
                    <div class="mb-0">
                        <label class="form-label"></label>
                        <button type="submit" class="btn btn-primary form-select">Apply Filter</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Transaction List Table -->
        <div class="table-responsive mt-3">
            <table id="transactionTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Part Number</th>
                        <th>Transaction Type</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Static sample rows -->
                    <tr>
                        <td>2024-09-01</td>
                        <td>P12345</td>
                        <td>Inbound</td>
                        <td>50</td>
                        <td><a href="{{ route('stocks.create') }}" class="btn btn-info">View Details</a></td>
                    </tr>
                    <tr>
                        <td>2024-09-03</td>
                        <td>P12346</td>
                        <td>Outbound</td>
                        <td>20</td>
                        <td><a href="{{ route('stocks.create') }}" class="btn btn-info">View Details</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
