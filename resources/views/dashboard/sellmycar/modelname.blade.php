@extends('layouts.dashboardlayout')
@section('title', 'Edit Part')
@section('breadcrumb1', 'Inventory Management')
@section('breadcrumb', 'Edit Part')
@section('pageTitle', 'Edit Part')
@section('content')




    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createInventoryModalLabel">Add Your Car Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Inventory Form -->
                <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
    <label for="city" class="form-label">City</label>
    <input type="text" id="city" name="city" class="form-control" placeholder="City" required>
</div>

                
                    <div class="mb-3">
    <label for="city" class="form-label">City</label>
    <input type="text" id="city" name="city_area" class="form-control" placeholder="City" required>
</div>
                
                    <div class="mb-3">
    <label for="city" class="form-label">City</label>
    <input type="text" id="city" name="Registered_user" class="form-control" placeholder="City" required>
</div>

    
<div class="mb-3">
                
                <label for="model_year" class="form-label">Model Year</label>
                <select id="model_year" name="model_yaer" class="form-control" required>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                </select>
            </div>
            
<div class="mb-3">
    <label for="model_company" class="form-label">Select Your Car Name</label>
    <select id="model_company" name="model_company" class="form-control" required>
        <option value="Cultus">Cultus</option>
        <option value="Civc">Civc</option>
        <option value="Corolla">Corolla</option>
        <option value="Mehran">Mehran</option>
    </select>
</div>


    <script>
        document.getElementById('model_year').addEventListener('change', function() {
            var selectedYear = this.value;
            if (selectedYear === '2011' || selectedYear === '2012') {
                window.location.href = '{{ route('model_name') }}' + '?year=' + selectedYear;
            }
        });

        document.getElementById('model_company').addEventListener('change', function() {
                var selectedCompany = this.value;
        
                if (selectedCompany) {
                    try {
                        // Redirect to the 'company_name' route with the selected company as a query parameter
                        window.location.href = '{{ route('model_company') }}' + '?company=' + selectedCompany;
                    } catch (error) {
                        console.error('Error occurred while redirecting: ', error);
                    }
                }
            });
        </script>
        


             
                                    <div class="mb-3">
                        <label for="car_info" class="form-label">Car Info</label>
                        <input type="text" id="car_info" name="car_info" class="form-control"
                            placeholder="Car Info">
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" id="color" name="color" class="form-control" placeholder="Color">
                    </div>
                    <div class="mb-3">
                        <label for="mileage" class="form-label">Mileage</label>
                        <input type="number" id="mileage" name="mileage" class="form-control" placeholder="Mileage">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" id="price" name="price" class="form-control"
                            placeholder="Price">
                    </div>
                    <div class="mb-3">
                        <label for="add_description" class="form-label">Add Description</label>
                        <textarea id="add_description" name="add_description" class="form-control" placeholder="Add Description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="upload_image" class="form-label">Upload Photo</label>
                        <input type="file" id="upload_image" name="upload_image" class="form-control">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endsection
