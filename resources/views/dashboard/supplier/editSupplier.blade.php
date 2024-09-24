@extends('layouts.dashboardlayout')
@section('title', 'Edit Supplier')
@section('breadcrumb1', 'Supplier Management')
@section('breadcrumb', 'Edit Supplier')
@section('pageTitle', 'Edit Supplier')
@section('content')

    <div class="container">
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Supplier Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Supplier Name"
                    value="{{ $supplier->name }}" required>
            </div>
            <div class="mb-3">
                <label for="contact_info" class="form-label">Contact Info</label>
                <textarea id="contact_info" name="contact_info" class="form-control" placeholder="Contact Info" required>{{ $supplier->contact_info }}</textarea>
            </div>
            <div class="mb-3">
                <label for="lead_time" class="form-label">Lead Time (in days)</label>
                <input type="number" id="lead_time" name="lead_time" class="form-control" placeholder="Lead Time"
                    value="{{ $supplier->lead_time }}" required>
            </div>
            <div class="mb-3">
                <label for="payment_terms" class="form-label">Payment Terms</label>
                <textarea id="payment_terms" name="payment_terms" class="form-control" placeholder="Payment Terms" required>{{ $supplier->payment_terms }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

@endsection
