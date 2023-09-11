<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return response()->json($departments);
    }

    public function store(Request $request)
    {
        $rules = ['name' => 'required|string|min:1|max:100'];
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ],400);
        }
        $department = new Departament($request->input());
        $department ->save();

            return response()->json([
                'status' => true,
                'message' => 'Department created sucessfully!',
            ],200);
    }


    public function show(Department $department)
    {
        return response()->json(['status' => true, 'data' => $department]);

    }

    public function update(Request $request, Departament $department)
    {
        $rules = ['name' => 'required|string|min:1|max:100'];
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ],400);
        }
            $department ->update($request->input());
            return response()->json([
                'status' => true,
                'message' => 'Department updated sucessfully!',
        ],200);
    }

    public function destroy(Department $department)
    {
        $departament ->delete();
            return response()->json([
                'status' => true,
                'message' => 'Department deleted sucessfully!',
        ],200);
    }

    public function EmployeesByDepartment(){
    $employees = Employee::select(DB::raw('count(employees.id) as count, departments.name')) 
        ->join('departments', 'departments.id', '=', 'employees.department_id')
        ->groupBy('departments.name')
        ->get();
    return response()->json($employees);
}

    public function all(){
        $employees = Employee::select('employeesdepartment_id')
        ->join('departments', 'departments.id', '=', 'employees.department_id')
        ->get();
        return response()->json($employees);
    }
}
