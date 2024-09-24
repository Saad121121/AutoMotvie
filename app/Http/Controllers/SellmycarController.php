<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellMyCar;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SellmycarController extends Controller
{
    public function Sellmycar(Request $request)
    {
        
        // Validate the request data (including 'city' now)
        
        // Save the();
    
        return view('dashboard.sellmycar.sellcar');
       // Show the form to add a model name
    }
    
    

    public function create(Request $request)
    {
        // Validate the request data
        $request->validate([
            'city' => 'required|string|max:255',
            'city_area' => 'required|string|max:255',
            'car_info' => 'required|string|max:255',
            'model_yaer' => 'required|string',
            'model_company' => 'required|string',
            'company_name' => 'required|string',
            'Registered_user' => 'required|string',
            'color' => 'nullable|string|max:255',
            'mileage' => 'required|numeric',
            'price' => 'required|numeric',
            'add_description' => 'nullable|string',
        ]);
    
        // Create a new SellMyCar instance
        $user = auth()->user();
        $save = new SellMyCar();
      
      
        $save->user_id = $user->id;
        // Set the attributes from the request
        $save->city = $request->input('city');
        $save->city_area = $request->input('city_area');
        $save->car_info = $request->input('car_info');
        $save->color = $request->input('color');
        $save->mileage = $request->input('mileage');
        $save->price = $request->input('price');
        $save->add_description = $request->input('add_description');
        $save->model_yaer = $request->input('model_yaer');
        $save->model_company = $request->input('model_company');
        $save->company_name = $request->input('company_name');
        $save->Registered_user = $request->input('Registered_user');
    
        // Add the authenticated user's ID (user_id)
        $save->user_id = $user->id;  // Add this line to save user_id
    
        // Handle the file upload
        if ($request->hasFile('upload_image')) {
            try {
                $image = $request->file('upload_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
    
                $save->upload_image = $imagePath;
            } catch (\Exception $e) {
                // Handle the exception
                return redirect()->back()->withErrors(['upload_image' => 'File upload failed: ' . $e->getMessage()]);
            }
        } else {
            // Default image path if no image is uploaded
            $save->upload_image = 'images/default_image.jpg';
        }
    
        // Save the record to the database
        $save->save();
    
        // Redirect with success message
        return redirect()->route('show')->with('success', 'Car added successfully!');
    }
    

        public function show()
    {
        $show = DB::table('sell_my_cars')->get();
        return view('dashboard.sellmycar.show', compact('show'));
    }

    public function destroy($id)
    {
        $show =  SellMyCar::find($id);
        $show->delete();
        return view('dashboard.sellmycar.show', compact('show'));
    }

    public function edit($id)
    {
        $sellmycar = SellMyCar::findOrFail($id);
        
        $modelYear = DB::table('sell_my_cars')
            ->where('id', $id)
            ->select('model_yaer')
            ->first();
    
        // Check if model year is one of the desired values
        if (in_array($modelYear->model_yaer, [2011, 2012, 2013, 2014])) {
            // The model year is one of the valid years
            $modelYearValue = $modelYear->model_yaer; // Access the property
            return view('dashboard.sellmycar.edit', compact('sellmycar', 'modelYearValue'));
        } else {
            return "Model year not valid!";
        }
    }

    
    public function model_name(Request $request)
    {  // Validate the request data (including 'city' now)

            return view('dashboard.sellmycar.modelname');
        
    }
    public function model_name_create(Request $request)
    {
        // Validate the request data (including 'city' now)
        $request->validate([
            'city' => 'required|string|max:255',
            'city_area' => 'required|string|max:255',
            'car_info' => 'required|string|max:255',
            'model_yaer' => 'required|string',
            'model_company' => 'required|string',
            'company_name' => 'required|string',
            'Registered_user' => 'required|string',
            'color' => 'nullable|string|max:255',
            'mileage' => 'required|numeric',
            'price' => 'required|numeric',
            'add_description' => 'nullable|string',
        ]);
    
        // Create a new SellMyCar instance
        $save = new SellMyCar();
    
        // Set the attributes from the request
        $save->city = $request->input('city');  // Include city
        $save->city_area = $request->input('city_area');  // Include city
        $save->car_info = $request->input('car_info');  // Include city
        $save->color = $request->input('color');
        $save->mileage = $request->input('mileage');
        $save->price = $request->input('price');
        $save->add_description = $request->input('add_description');
        $save->model_yaer = $request->input('model_yaer');
        $save->model_company = $request->input('model_company');
        $save->company_name = $request->input('company_name');
        $save->Registered_user = $request->input('Registered_user');
       // Handle the file upload
       if ($request->hasFile('upload_image')) {
        try {
            $image = $request->file('upload_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;

            $save->upload_image = $imagePath;
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->withErrors(['upload_image' => 'File upload failed: ' . $e->getMessage()]);
        }
    } else {
        // Default image path if no image is uploaded
        $save->upload_image = 'images/default_image.jpg';
    }
        // Save the record to the database
        $save->save();
    
        // Redirect with success message
        return redirect()->route('show')->with('success', 'Car added successfully!');
    }
    public function model_company()
    {
          // Get the selected company from the query parameter

          // Perform any logic with the company, like fetching related models
          // Example: Return view with company-related data
          return view('dashboard.sellmycar.model_company');
       
        
    }
    
    




    public function update(Request $request, $id)
    {
        // Find the existing record
        $sellmycar = SellMyCar::findOrFail($id);



        // Update fields
        // $sellmycar->city = $request->input('city');
        // $sellmycar->city_area = $request->input('city_area');
        $sellmycar->car_info = $request->input('car_info');
        $sellmycar->color = $request->input('color');
        $sellmycar->mileage = $request->input('mileage');
        $sellmycar->price = $request->input('price');
        $sellmycar->add_description = $request->input('add_description');

        // // Handle file upload
        // if ($request->hasFile('upload_image')) {
        //     try {
        //         $image = $request->file('upload_image');
        //         $imageName = time() . '.' . $image->getClientOriginalExtension();
        //         $image->move(public_path('images'), $imageName);
        //         $imagePath = 'images/' . $imageName;

        //         $sellmycar->upload_image = $imagePath;
        //     } catch (\Exception $e) {
        //         // Handle the exception
        //         return redirect()->back()->withErrors(['upload_image' => 'File upload failed: ' . $e->getMessage()]);
        //     }
        // } else {
        //     // Default image path if no image is uploaded
        //     $sellmycar->upload_image = 'images/default_image.jpg';
        // }


        // Save the updated record
        $sellmycar->save();

        return redirect()->route('show')->with('success', 'Car updated successfully!');
    }
}
