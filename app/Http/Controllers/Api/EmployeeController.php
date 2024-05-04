<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function listEmployees()
    {
        $employees=Employee::get();
        return response()->json([
            "status"=>200,
            "message"=>"Listing Employees",
            "data"=>$employees
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function createEmployee(EmployeeStoreRequest $request)
    {
        Employee::create([
            "name"=>$request->name,
            "email" =>$request->email,
            "phone_no"=>$request->phone_no,
            "age"=>$request->age,
            "gender"=>$request->gender,
        ]);

        return response()->json([
            "status"=>200,
            "message"=>"Employee created successfully"
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function getSingleEmployee(string $id)
    {
        if(Employee::where("id",$id)->exists()){
            $employee_detail=Employee::where("id",$id)->first();

            return response()->json([
                "status"=>200,
                "message"=>"Employee found",
                "data"=>$employee_detail
            ]);

        }else{

            return response()->json([
                "status"=>404,
                "message"=>"Employee not found"
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateEmployee(EmployeeUpdateRequest $request, string $id)
    {
        if(Employee::where("id",$id)->exists()){
            $employee=Employee::find($id);

            $employee->name=!empty($request->name) ? $request->name : $employee->name ;
            $employee->email=!empty($request->email) ? $request->email : $employee->email ;
            $employee->phone_no=!empty($request->phone_no) ? $request->phone_no : $employee->phone_no;
            $employee->age=!empty($request->age) ? $request->age : $employee->age;
            $employee->gender=!empty($request->gender) ? $request->gender : $employee->gender;
            $employee->save();
            return response()->json([
                "status"=>200,
                "message"=>"Employee updated successfully"
            ]);
        }else{
            return response()->json([
                "status"=>404,
                "message"=>"Employee not found"
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyEmployee(string $id)
    {
        if(Employee::where("id",$id)->exists()){
            $employee=Employee::find($id);
            $employee->delete();
            return response()->json([
                "status"=>200,
                "message"=>"Employee deleted successfully"
            ]);
        }else{
            return response()->json([
                "status"=>404,
                "message"=>"Employee not found"
            ],404);
        }
    }
}
