@extends('layouts.dashboardlayout')
@section('title', 'Edit Part')
@section('breadcrumb1', 'Inventory Management')
@section('breadcrumb', 'Edit Part')
@section('pageTitle', 'Edit Part')
@section('content')

    <div class="container">
        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to edit part details -->
        <form action="{{ route('parts.update', $part->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="part_number" class="form-label">Part Number</label>
                <input type="text" name="part_number" id="part_number" class="form-control"
                    value="{{ old('part_number', $part->part_number) }}" required>
            </div>

            <div class="mb-3">
                <label for="part_name" class="form-label">Part Name</label>
                <input type="text" name="part_name" id="part_name" class="form-control"
                    value="{{ old('part_name', $part->part_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select id="category" name="category" class="form-select" required>
                    <option value="">Select a category</option>
                    <option value="Vehicle Parts"
                        {{ old('category', $part->category) == 'Vehicle Parts' ? 'selected' : '' }}>Vehicle Parts</option>
                    <option value="Showroom Supplies"
                        {{ old('category', $part->category) == 'Showroom Supplies' ? 'selected' : '' }}>Showroom Supplies
                    </option>
                    <option value="Accessories" {{ old('category', $part->category) == 'Accessories' ? 'selected' : '' }}>
                        Accessories</option>
                    <option value="Tools" {{ old('category', $part->category) == 'Tools' ? 'selected' : '' }}>Tools
                    </option>
                    <option value="Other" {{ old('category', $part->category) == 'Other' ? 'selected' : '' }}>Other
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" class="form-control"
                    value="{{ old('location', $part->location) }}" required>
            </div>

            <div class="mb-3">
                <label for="supplier_id" class="form-label">Supplier</label>
                <select name="supplier_id" id="supplier_id" class="form-control" required>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $part->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="stock_level" class="form-label">Stock Level</label>
                <input type="number" name="stock_level" id="stock_level" class="form-control"
                    value="{{ old('stock_level', $part->stock_level) }}" required>
            </div>

            <div class="mb-3">
                <label for="reorder_point" class="form-label">Reorder Point</label>
                <input type="number" name="reorder_point" id="reorder_point" class="form-control"
                    value="{{ old('reorder_point', $part->reorder_point) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('parts.index') }}" class="btn btn-secondary">Back to List</a>
        </form>
    </div>

@endsection
