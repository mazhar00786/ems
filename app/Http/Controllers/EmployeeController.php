<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = Employee::paginate(10);

        return view('home', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $companies = Company::all();
        
        return view('employee.add_employee')->with('companies', $companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'dob' => 'required|date',
            'address' => 'required',
            'phone' => 'required',
            'department' => 'required'
        ]);

        $employee = new Employee();

        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->dob = $request->input('dob');
        $employee->address = $request->input('address');
        $employee->phone = $request->input('phone');
        $employee->department = $request->input('department');
        //  return $employee;
        $employee->save();

        Alert::success('Employee Saved Successfully');
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employee = Employee::findOrFail($id);

        $companies = Company::all();

        return view('employee.edit_employee')->with('employee', $employee)->with('companies', $companies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'dob' => 'required|date',
            'address' => 'required',
            'phone' => 'required',
            'department' => 'required'
        ]);

        $employee = Employee::findOrFail($id);

        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->dob = $request->input('dob');
        $employee->address = $request->input('address');
        $employee->phone = $request->input('phone');
        $employee->department = $request->input('department');
        //  return $employee;
        $employee->update();

        Alert::success('Employee Updated Successfully');
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $employee = Employee::find($id);

        $employee->delete();

        
        Alert::success('Employee Deleted Successfully');
        return redirect('/home'); 
    }
}
