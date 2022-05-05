<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *    , 'throttle:3,5')->only('admin.login'
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        

        if ($request->ajax()) {
            # code...
            $output="";
            $employees = Employee::where('title','LIKE','%'.$request->search."%")->paginate(10);
            if($employees)
            {
                foreach ($employees as $key => $employee) {
                    $output.='<tr>'.
                    '<td>'.$employee->id.'</td>'.
                    '<td>'.$employee->name.'</td>'.
                    '<td>'.$employee->email.'</td>'.
                    '<td>'.$employee->dob.'</td>'.
                    '<td>'.$employee->phone.'</td>'.
                    '<td>'.$employee->address.'</td>'.
                    '<td>'.$employee->department.'</td>'.
                    '</tr>';
                }
                // return Response($output);
                return view('home', response('employees'));
            }        
        } else {
            $employees = Employee::paginate(10);
            return view('home', compact('employees'));
        }

        // return view('home', compact('employees'));
    }
}
