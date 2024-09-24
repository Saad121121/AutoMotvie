@extends('layouts.dashboardlayout')
@section('title', 'Transaction Details')
@section('breadcrumb1', 'Inventory Management')
@section('breadcrumb', 'Transaction Details')
@section('pageTitle', 'Transaction Details')
@section('content')

    <div class="container">
        <!-- Transaction Details -->
        <div class="card">
            <div class="card-header">
                <h4 id="transactionTitle">Transaction #12345</h4>
            </div>
            <div class="card-body">
                <p><strong>Date:</strong> <span id="transactionDate">2024-09-01</span></p>
                <p><strong>Part Number:</strong> <span id="partNumber">P12345</span></p>
                <p><strong>Transaction Type:</strong> <span id="transactionType">Inbound</span></p>
                <p><strong>Quantity:</strong> <span id="quantity">50</span></p>
                <p><strong>Reference Number:</strong> <span id="referenceNumber">REF123456</span></p>
                <p><strong>Stock Level After Transaction:</strong> <span id="stockLevel">150</span></p>
                <!-- Buttons for Edit and Reverse Transaction -->
                <div class="mt-3">
                    <button type="button" class="btn btn-warning" onclick="showEditSuccess()">Edit Transaction</button>
                    <button type="button" class="btn btn-danger" onclick="reverseTransaction()">Reverse
                        Transaction</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function getRandomDate() {
            const start = new Date(2024, 0, 1);
            const end = new Date();
            return new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
        }

        function getRandomPartNumber() {
            return 'P' + Math.floor(Math.random() * 100000).toString().padStart(5, '0');
        }

        function getRandomTransactionType() {
            return Math.random() > 0.5 ? 'Inbound' : 'Outbound';
        }

        function getRandomQuantity() {
            return Math.floor(Math.random() * 100) + 1;
        }

        function getRandomReferenceNumber() {
            return 'REF' + Math.floor(Math.random() * 1000000).toString().padStart(6, '0');
        }

        function updateTransactionDetails() {
            document.getElementById('transactionDate').innerText = getRandomDate().toISOString().split('T')[0];
            document.getElementById('partNumber').innerText = getRandomPartNumber();
            document.getElementById('transactionType').innerText = getRandomTransactionType();
            document.getElementById('quantity').innerText = getRandomQuantity();
            document.getElementById('referenceNumber').innerText = getRandomReferenceNumber();
            document.getElementById('stockLevel').innerText = getRandomQuantity(); // Random stock level
        }

        function showEditSuccess() {
            alert('Transaction has been successfully edited!');
        }

        function reverseTransaction() {
            // Update the stock level to zero
            document.getElementById('stockLevel').innerText = '0';
            // Show success alert
            alert('Transaction has been successfully reversed! Stock level is now zero.');
        }

        document.addEventListener('DOMContentLoaded', updateTransactionDetails);
    </script>
@endpush
