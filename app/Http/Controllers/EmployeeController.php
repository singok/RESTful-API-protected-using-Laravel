<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'email' => 'required | email | unique:employees',
            'phone' => 'required',
            'address' => 'required',
            'postcode' => 'required'
        ]);

        $info = Employee::create($request->all());
        if ($info) {
            return response(['success' => 'Employee Added Successfully.']);
        } else {
            return response(['failure' => 'Something went wrong.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Employee::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $info = Employee::find($id)->update($request->all());
        if ($info) {
            return response([
                'success' => 'Employee Updated Successfully.'
            ]);
        } else {
            return response([
                'failure' => 'Something went wrong.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $info = Employee::find($id)->delete();
        if ($info) {
            return response(['success' => 'Employee Deleted Successfully.']);
        } else {
            return response(['failure' => 'Something went wrong.']);
        }
    }
}
