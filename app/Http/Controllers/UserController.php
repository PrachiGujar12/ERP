<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Database\QueryException;

use App\Http\Controllers\Controller;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
        {
            $Users = User::all();

            // Count total users by each user_type
            $userCounts = \DB::table('users')
                ->select('user_type', \DB::raw('count(*) as total'))
                ->groupBy('user_type')
                ->pluck('total', 'user_type')
                ->toArray();

            // Prepare data for the chart
            $chartData = [
                'labels' => array_keys($userCounts),
                'data' => array_values($userCounts),
            ];

            return view('admin.staff.index', compact('Users','chartData'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'mobile_no' => ['required'],
            'address' => ['required'],
            'designation' => ['required'],
            'password' => ['required', Rules\Password::defaults()],
            'user_type' => 'required|array',
            'user_type.*' => 'string|in:purchase,staff,customer,karigar,supplier,stock,rates,repair-items,sale,scrap-gold,quotation,ncsale',
        ]);
    
        $userTypes = $request->input('user_type', []);

        // Convert the array to a comma-separated string
        $userTypesString = implode(', ', $userTypes);

        // dd($userTypesString);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'designation' => $request->designation,
            'password' => Hash::make($request->password),
            'user_type' => $userTypesString,
        ]);

        // dd($user);
        return redirect()->route('staff.index')->with('success', 'Staff created successfully.');

        // if ($request->has('cartype')) {
        //     // Convert the array of selected amenities to a comma-separated string
        //     $cartype = $request->input('cartype');
        //     if (is_array($cartype)) {
        //         $cartypeString = implode(', ', $cartype);
        //         $cartypess = $cartypeString;
        //     }
        // }

        // $package->car_type = $cartypess;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.staff.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                // Customize the unique rule to ignore the current user's ID
                Rule::unique('users')->ignore($id)
            ],  
            'mobile_no' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'user_type' => 'required|array',
            'user_type.*' => 'string|in:purchase,staff,customer,karigar,supplier,stock,rates,repair-items,sale,scrap-gold,quotation,ncsale',
        ]);
    
        $User = User::findOrFail($id);
        $userTypes = $request->input('user_type', []);

        // Convert the array to a comma-separated string
        $userTypesString = implode(', ', $userTypes);

        $User->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $userTypesString,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'designation' => $request->designation,
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();

            return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
        } catch (QueryException $e) {
            // Check if the exception is due to foreign key constraints
            if ($e->getCode() === '23000') {
                return redirect()->route('staff.index')->with('error', 'Unable to delete staff. There is associated data under this staff.');
            }
            // Handle other exceptions or rethrow
            throw $e;
        }
    }
}
