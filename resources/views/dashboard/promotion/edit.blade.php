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

        <form action="{{ route('promotions.update', $promotion->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $promotion->name }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image" class="form-control">
                @if ($promotion->image)
                    <img src="{{ asset('storage/images/' . $promotion->image) }}" alt="{{ $promotion->name }}"
                        width="100">
                @endif
            </div>

            <div class="mb-3">
                <label for="details" class="form-label">Details</label>
                <textarea id="details" name="details" class="form-control" required>{{ $promotion->details }}</textarea>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control"
                    value="{{ $promotion->start_date }}" required>
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $promotion->end_date }}"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Update Promotion</button>
        </form>
    </div>

@endsection
