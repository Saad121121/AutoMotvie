@extends('layouts.dashboardlayout')
@section('content')



<!-- Sell Your Car Button -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sellCarModal">
  Sell Your Car
</button>


   <!-- Modal Structure -->
<div class="modal fade" id="sellCarModal" tabindex="-1" aria-labelledby="sellCarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sellCarModalLabel">Sell Your Car</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Inventory Form -->
        <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <select id="city" name="city" class="form-control" required>
              <option value="">Select City</option>
              <option value="Karachi">Karachi</option>
              <option value="Lahore">Lahore</option>
              <option value="Islamabad">Islamabad</option>
            </select>
          </div>

          <!-- City Area Selection -->
          <div class="mb-3" id="city_area_div" style="display: none;">
            <label for="city_area" class="form-label">City Area</label>
            <select id="city_area" name="city_area" class="form-control" required>
              <option value="shahdman hagh">Shahdman Hagh</option>
              <option value="mughal pura">Mughal Pura</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="Registered_user" class="form-label">Registration</label>
            <select id="Registered_user" name="Registered_user" class="form-control" required>
              <option value="Registered">Registered</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="model_year" class="form-label">Model Year</label>
            <select id="model_year" name="model_yaer" class="form-control" required>
              <option value="">Select Model Year</option>
              <option value="2011">2011</option>
              <option value="2012">2012</option>
              <option value="2013">2013</option>
              <option value="2014">2014</option>
            </select>
          </div>

          <div class="mb-3" id="model_name_div" style="display: none;">
            <label for="model_name" class="form-label">Model Name</label>
            <select id="model_name" name="model_company" class="form-control" required>
              <option value="">Select Model Name</option>
              <option value="Civic">Civic</option>
              <option value="Corolla">Corolla</option>
              <option value="Alto">Alto</option>
            </select>
          </div>

          <div class="mb-3" id="model_company_div" style="display: none;">
            <label for="model_company" class="form-label">Model Company</label>
            <select id="model_company" name="company_name" class="form-control" required>
              <option value="">Select Model Company</option>
              <option value="Toyota">Toyota</option>
              <option value="Honda">Honda</option>
              <option value="Suzuki">Suzuki</option>
            </select>
          </div>

          <!-- Other form fields -->
          <div class="mb-3">
            <label for="car_info" class="form-label">Car Info</label>
            <input type="text" id="car_info" name="car_info" class="form-control" placeholder="Car Info">
        </div>
        <input type="hidden" id="user_id" name="user_id" class="form-control" placeholder="user_id">

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
            <input type="number" step="0.01" id="price" name="price" class="form-control" placeholder="Price">
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
            <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


    <script>
    document.getElementById('city').addEventListener('change', function() {
    var selectedCity = this.value;
    var cityAreaDiv = document.getElementById('city_area_div');
    var cityAreaSelect = document.getElementById('city_area');

    // Clear previous city area options
    cityAreaSelect.innerHTML = '';

    if (selectedCity === 'Karachi') {
        // Show city area options for Karachi
        cityAreaSelect.innerHTML = `
            <option value="Shah Faisal">Shah Faisal</option>
            <option value="Model Colony">Model Colony</option>
            <option value="Drigh Road">Drigh Road</option>
        `;
        cityAreaDiv.style.display = 'block';
    } else if (selectedCity === 'Lahore') {
        // Show city area options for Lahore
        cityAreaSelect.innerHTML = `
            <option value="Shahdman">Shahdman</option>
            <option value="Mughalpura">Mughalpura</option>
        `;
        cityAreaDiv.style.display = 'block';
    } else if (selectedCity === 'Islamabad') {
        // Show city area options for Islamabad
        cityAreaSelect.innerHTML = `
            <option value="G-6">G-6</option>
            <option value="F-7">F-7</option>
        `;
        cityAreaDiv.style.display = 'block';
    } else {
        // Hide city area if no city is selected
        cityAreaDiv.style.display = 'none';
    }
});

</script>

<script>
    // Show Model Name dropdown when Model Year is selected
    document.getElementById('model_year').addEventListener('change', function() {
        var selectedYear = this.value;
        var modelNameDiv = document.getElementById('model_name_div');

        if (selectedYear !== "") {
            modelNameDiv.style.display = 'block'; // Show the Model Name dropdown
        } else {
            modelNameDiv.style.display = 'none'; // Hide the Model Name dropdown
            document.getElementById('model_company_div').style.display = 'none'; // Hide the Model Company dropdown if model year is deselected
        }
    });

    // Show Model Company dropdown when Model Name is selected
    document.getElementById('model_name').addEventListener('change', function() {
        var selectedModel = this.value;
        var modelCompanyDiv = document.getElementById('model_company_div');

        if (selectedModel !== "") {
            modelCompanyDiv.style.display = 'block'; // Show the Model Company dropdown
        } else {
            modelCompanyDiv.style.display = 'none'; // Hide the Model Company dropdown
        }
    });
</script>

<script>
document.getElementById('submitButton').addEventListener('click', function(event) {
        // Get the selected city and city area values
        var city = document.getElementById('city').value;
        var cityArea = document.getElementById('city_area').value;

        // Create a confirmation dialog showing the selected city and city area
        var confirmation = window.confirm('Are you sure you want to publish your ad?\n\nCity: ' + city + '\nCity Area: ' + cityArea);

        if (confirmation) {
            // If the user clicks "Yes", submit the form
            document.forms[0].submit();
        }
        // If the user clicks "No", nothing happens
    });
</script>
@endsection