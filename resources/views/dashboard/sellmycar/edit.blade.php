<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Edit Car Information</h2>
    <form action="{{ route('sellmycar.update', $sellmycar->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Use PUT method to update the record -->
    
    <div class="mb-3">
        <label for="city" class="form-label">City</label>
        <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $sellmycar->city) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="city_area" class="form-label">City Area</label>
        <input type="text" id="city_area" name="city_area" class="form-control" value="{{ old('city_area', $sellmycar->city_area) }}">
    </div>

    <div class="mb-3">
        <label for="car_info" class="form-label">Car Info</label>
        <input type="text" id="car_info" name="car_info" class="form-control" value="{{ old('car_info', $sellmycar->car_info) }}">
    </div>

    <div class="mb-3">
        <label for="color" class="form-label">Color</label>
        <input type="text" id="color" name="color" class="form-control" value="{{ old('color', $sellmycar->color) }}">
    </div>

    <div class="mb-3">
        <label for="mileage" class="form-label">Mileage</label>
        <input type="number" id="mileage" name="mileage" class="form-control" value="{{ old('mileage', $sellmycar->mileage) }}" required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" id="price" name="price" class="form-control" value="{{ old('price', $sellmycar->price) }}" required>
    </div>

    <div class="mb-3">
        <label for="add_description" class="form-label">Description</label>
        <textarea id="add_description" name="add_description" class="form-control">{{ old('add_description', $sellmycar->add_description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="upload_image" class="form-label">Upload Image</label>
        <input type="file" id="upload_image" name="upload_image" class="form-control">
        
        @if($sellmycar->upload_image)
            <div class="mt-2">
                <img src="{{ asset('/' . $sellmycar->upload_image) }}" alt="Uploaded Image" style="width: 100px; height: auto;">
                <!-- This hidden input will retain the existing image path -->
                <input type="hidden" name="existing_image" value="{{ $sellmycar->id }}">
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Update Car</button>
</form>

    
</div>

</body>
</html>
