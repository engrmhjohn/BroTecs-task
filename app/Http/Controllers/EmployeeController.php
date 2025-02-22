<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function saveEmployee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|max:14|unique:employees,phone',
            'email' => 'required|email|unique:employees,email',
            'address' => 'required|string|min:5|max:255|regex:/^[a-zA-Z0-9\s,.-]+$/',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'name.required' => 'Please enter the employee name.',
            'name.string' => 'The name must be a valid text.',
            'name.max' => 'The name cannot exceed 255 characters.',
        
            'phone.required' => 'Please enter a phone number.',
            'phone.max' => 'The phone number cannot be longer than 14 digits.',
            'phone.unique' => 'This phone number is already registered.',
        
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email format.',
            'email.unique' => 'This email is already in use.',
        
            'address.required' => 'Please enter an address.',
            'address.string' => 'The address must be valid text.',
            'address.min' => 'The address must be at least 5 characters long.',
            'address.max' => 'The address cannot be longer than 255 characters.',
            'address.regex' => 'The address can only contain letters, numbers, spaces, commas, dots, and hyphens.',
        
            'profile_picture.required' => 'Please upload a profile picture.',
            'profile_picture.image' => 'The uploaded file must be an image.',
            'profile_picture.mimes' => 'Only JPEG, PNG, JPG, GIF, and WEBP formats are allowed.',
            'profile_picture.max' => 'The profile picture size must not exceed 2MB.',
        ]);     

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle file upload
        if ($request->hasFile('profile_picture')) {
            $imageName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->move(public_path('uploads/employees'), $imageName);
        } 

        $employee = Employee::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'profile_picture' => $imageName,
        ]);

        return response()->json([
            'success' => 'Employee added successfully!',
            'employee' => $employee,
        ]);
    }
    public function fetchEmployees()
    {
        $employees = Employee::all();
        return response()->json(['employees' => $employees]);
    }
    public function editEmployee($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }
    public function updateEmployee(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|max:14|unique:employees,phone,' . $id,
            'email' => 'required|email|max:255|unique:employees,email,' . $id,
            'address' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s,.-]+$/',
        ], [
            'name.required' => 'Please enter the employee name.',
            'name.string' => 'The name must be a valid text.',
            'name.max' => 'The name cannot exceed 255 characters.',
        
            'phone.required' => 'Please enter a phone number.',
            'phone.max' => 'The phone number cannot be longer than 14 digits.',
            'phone.unique' => 'This phone number is already in use.',
        
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email format.',
            'email.max' => 'The email cannot exceed 255 characters.',
            'email.unique' => 'This email is already in use.',
        
            'address.required' => 'Please enter an address.',
            'address.string' => 'The address must be valid text.',
            'address.max' => 'The address cannot be longer than 255 characters.',
            'address.regex' => 'The address can only contain letters, numbers, spaces, commas, dots, and hyphens.',
        ]);        

        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->address = $request->address;

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/employees'), $imageName);
            $employee->profile_picture = $imageName;
        }

        $employee->save();

        return response()->json(['success' => 'Employee updated successfully!']);
    }
    public function deleteEmployee($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->delete();
            return response()->json(['success' => 'Employee deleted successfully!']);
        } else {
            return response()->json(['error' => 'Employee not found!']);
        }
    }
}
