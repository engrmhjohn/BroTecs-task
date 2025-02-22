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
            'phone' => 'required|max:13|unique:employees,phone',
            'email' => 'required|email|unique:employees,email',
            'address' => 'required|string',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle file upload
        if ($request->hasFile('profile_picture')) {
            $imageName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->move(public_path('uploads/employees'), $imageName);
        } else {
            $imageName = 'uploads/employees/avatar.png'; // Default profile picture
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
            'name' => 'required',
            'phone' => 'required|unique:employees,phone,' . $id,
            'email' => 'required|unique:employees,email,' . $id,
            'address' => 'required',
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
