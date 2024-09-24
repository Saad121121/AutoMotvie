<?php

namespace App\Http\Controllers\DashboardControllers;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\User;
use App\Models\Role;
use App\Models\Showroom;
use App\Models\Staff;
use App\Models\UserActivityLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index()
    {
        $currentUserId = Auth::id();
        $showroomId = Auth::user()->showroom_id;
        $roleId = Auth::user()->role_id;
        if ($roleId != 5 && $showroomId == '') {
            return view('dashboard.index');
        }

        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3) {
            $users = User::with('role', 'showroom')
                ->where('showroom_id', $showroomId)
                ->where('id', '!=', $currentUserId)
                ->where('showroom_id', '!=', 1)
                ->where('role_id', '!=', 4)
                ->orderBy('id', 'desc')->get();
            $showrooms = [];
            $rol = [2, 3, 1];

            $roles = Role::whereIn('id', $rol)->orderBy('id', 'desc')->get();
        } elseif (Auth::user()->role_id == 5) {
            $users = User::with('role', 'showroom')
                ->where('id', '!=', $currentUserId)
                ->where('role_id', '!=', 4)
                ->orderBy('id', 'desc')->get();
            $showrooms = Showroom::orderBy('id', 'desc')->get();
            $roles = Role::where('id', '!=', 4)
                ->orderBy('id', 'desc')->get();
        }

        return view('dashboard.users.index', compact('roles', 'users', 'showrooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role_id' => 'required|exists:roles,id',
            'showroom_id' => 'nullable|exists:showrooms,id',
        ]);

        if ($request->input('role_id') == 2) {
            $Showmang = User::where('role_id', 2)->where('showroom_id', Auth::user()->showroom_id)->first();
            if ($Showmang) {
                return redirect()->route('user.index')->with('error', 'You are not authorized to create users in this showroom.');
            }
        }

        // Handle the image upload
        $imagePath = null;
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     // Store the image in the custom directory
        //     $imagePath = $image->store('users', 'custom_users'); // 'custom_users' disk points to public/storage/images/users
        // }

        // Create the user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // Hash the password
        $user->role_id = $request->input('role_id');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/users');
            $user->image  = basename($imagePath);
        }

        $user->showroom_id = $request->input('showroom_id');

        $user->save();

        // Activity log
        $log = new UserActivityLog();
        $log->user_id = Auth::user()->id;
        $log->action = 'Created user: ' . $user->name . ' Email : ' . $user->email;
        $log->showroom_id = Auth::user()->showroom_id;
        $log->created_at = now();
        $log->save();

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            // Validate the request
            $uId = $request->input('userId');
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($uId),
                ],
                'password' => 'nullable|string|min:8',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'role_id' => 'required|exists:roles,id',
                'showroom_id' => 'nullable|exists:showrooms,id',

            ]);

            // Find the user
            if ($request->input('role_id') == 2) {
                $Showmang = User::where('role_id', 2)->where('showroom_id', Auth::user()->showroom_id)->first();
                if ($Showmang) {
                    return redirect()->route('user.index')->with('error', 'You cannot create another manager of this showroom.');
                }
            }
            $user = User::findOrFail($uId);
            // Update user details
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role_id = $request->input('role_id');
            $user->showroom_id = $request->input('showroom_id');;


            // Update password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/users');
                $user->image  = basename($imagePath);
            }


            // Save the user
            $user->save();

            $log = new UserActivityLog();
            $log->user_id = Auth::user()->id;
            $log->action = 'Updated user: ' . $user->name . ' Email : ' . $user->email;
            $log->showroom_id = Auth::user()->showroom_id;
            $log->created_at = now();
            $log->save();

            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        } catch (Exception $e) {
            // Log the error


            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while updating the user. Please try again. ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user) {
                //activitylog
                $log = new UserActivityLog();
                $log->user_id = Auth::user()->id;
                $log->action = 'Deleted user: ' . $user->name . ' Email : ' . $user->email;
                $log->showroom_id = Auth::user()->showroom_id;
                $log->created_at = now();
                $log->save();
                $user->delete();
                return response()->json(['success' => 'User deleted successfully.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete User.'], 500);
        }
    }
    public function activity()
    {
        $usersActivity = [];

        if (isset(Auth::user()->showroom_id)) {
            $usersActivity = UserActivityLog::with('user', 'showroom')
                ->where('showroom_id', Auth::user()->showroom_id)
                ->orderBy('id', 'desc')
                ->get();
        } elseif (Auth::user()->role_id == 5) {
            $usersActivity = UserActivityLog::with('user', 'showroom')
                ->orderBy('id', 'desc')
                ->get();
        }

        // Prepare data for charts
        $actionsByUser = UserActivityLog::select('user_id', DB::raw('count(*) as total_actions'))
            ->groupBy('user_id')
            ->get();

        $actionsByDate = UserActivityLog::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total_actions'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        return view('dashboard.usersActivity.index', compact('usersActivity', 'actionsByUser', 'actionsByDate'));
    }

    public function customerIndex()
    {
        $currentUserId = Auth::id();

        // Fetch customers excluding the current user and role_id = 4
        $users = User::with('showroom')
            ->where('id', '!=', $currentUserId)
            ->where('role_id', 4)
            ->orderBy('id', 'desc')
            ->get();

        // Prepare data for charts
        $showroomData = User::selectRaw('showroom_id, COUNT(*) as customer_count')
            ->where('id', '!=', $currentUserId)
            ->where('role_id', 4)
            ->groupBy('showroom_id')
            ->with('showroom')
            ->get();


        if (Auth::user()->role_id == 5) {
            $showrooms = Showroom::where('id', '!=', 1)
                ->orderBy('id', 'desc')->get();
        } else {
            $showrooms = [];
        }
        // Extracting data for charts
        $showroomNames = $showroomData->pluck('showroom.shr_name')->toArray();
        $customerCounts = $showroomData->pluck('customer_count')->toArray();

        return view('dashboard.customer.index', compact('users', 'showroomNames', 'customerCounts', 'showrooms'));
    }
    public function customerStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'showroom_id' => 'nullable|exists:showrooms,id',
        ]);
        $imagePath = null;
        // Create the user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // Hash the password
        $user->role_id = 4;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/users');
            $user->image  = basename($imagePath);
        }

        $user->showroom_id = $request->input('showroom_id');

        $user->save();

        // Activity log
        $log = new UserActivityLog();
        $log->user_id = Auth::user()->id;
        $log->action = 'Created user: ' . $user->name . ' Email : ' . $user->email;
        $log->showroom_id = Auth::user()->showroom_id;
        $log->created_at = now();
        $log->save();

        return redirect()->route('customer')->with('success', 'User created successfully.');
    }
    public function customerEdit(Request $request)
    {
        // dd($request->all());
        try {
            // Validate the request
            $uId = $request->input('userId');
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($uId),
                ],
                'password' => 'nullable|string|min:8',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'showroom_id' => 'nullable|exists:showrooms,id',

            ]);


            $user = User::findOrFail($uId);
            // Update user details
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role_id = 4;
            $user->showroom_id = $request->input('showroom_id');;


            // Update password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/users');
                $user->image  = basename($imagePath);
            }


            // Save the user
            $user->save();

            $log = new UserActivityLog();
            $log->user_id = Auth::user()->id;
            $log->action = 'Updated user: ' . $user->name . ' Email : ' . $user->email;
            $log->showroom_id = Auth::user()->showroom_id;
            $log->created_at = now();
            $log->save();

            return redirect()->route('customer')->with('success', 'User updated successfully.');
        } catch (Exception $e) {
            // Log the error


            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while updating the user. Please try again. ' . $e->getMessage());
        }
    }
}
