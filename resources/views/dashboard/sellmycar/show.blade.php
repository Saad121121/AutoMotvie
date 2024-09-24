@extends('layouts.dashboardlayout')
@section('title', 'Schedule Service')
@section('breadcrumb1', 'Service')
@section('breadcrumb', 'Schedule Services')
@section('pageTitle', 'Schedule Services')
@section('content')

    <div class="container mt-4">
        <h2>Sell Car Customers Details </h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>City</th>
                    <th>City Area</th>
                    <th>Car Info</th>
                    <th>Color</th>
                    <th>Mileage</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Model Year </th>
                    <th>Model Name</th>
                    <th>Model Company</th>
                    <th>Upload Image</th>
                    <th>EDIT</th> <!-- Add column header for actions -->
                    <th>DELETE</th> <!-- Add column header for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach ($show as $showcars)
                    <tr>
                        <td>{{ $showcars->id }}</td>
                        <td>{{ $showcars->city }}</td>
                        <td>{{ $showcars->city_area }}</td>
                        <td>{{ $showcars->car_info }}</td>
                        <td>{{ $showcars->color }}</td>
                        <td>{{ $showcars->mileage }}</td>
                        <td>{{ $showcars->price }}</td>
                        <td>{{ $showcars->add_description }}</td>
                        <td>{{ $showcars->model_yaer }}</td>
                        <td>{{ $showcars->model_company }}</td>
                        <td>{{ $showcars->company_name }}</td>
                        <td>

                            @if ($showcars->upload_image)
                                <img src="{{ asset('/' . $showcars->upload_image) }}" alt="Uploaded Image"
                                    style="width: 100px; height: auto;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <!-- Edit button -->
                            <a href="{{ route('edit', $showcars->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                        </td>
                        <td>
                            <!-- Edit button -->
                            <button type="submit" href="{{ route('destroy', $showcars->id) }}"
                                class="btn btn-danger"><a href="{{ route('destroy', $showcars->id) }}">Delete</a></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
