<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = Company::paginate(10);

        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('company.add_company');
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
            'name' => 'required'
        ]);

        $company = new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
            
        if ($request->hasFile('logo')) {
                # code...
            $path = 'public/logo/';
            $logo = $request->file('logo');
            $extension = $logo->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $logo->storeAs($path, $fileName);

            $company->logo = $fileName;
        }

        $company->website = $request->input('website');
            
        $company->save();
        
        Alert::success('Company Saved Successfully');
        return redirect('/company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $company = Company::findOrFail($id);

        return view('company.edit_company')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        $company = Company::findOrFail($id);
        // return $company;
        $company->name = $request->input('name');
        $company->email = $request->input('email');
            
        if ($request->hasFile('logo')) {
            # code...
            $destination = 'storage/logo/' . $company->logo;

            if (File::exists($destination)) {
                # code...
                File::delete($destination);
            }

            $path = 'public/logo/';
            $logo = $request->file('logo');
            $extension = $logo->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $logo->storeAs($path, $fileName);

            $company->logo = $fileName;
        }

        $company->website = $request->input('website');
            
        $company->update();
        
        Alert::success('Company Updated Successfully');
        return redirect('/company');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $company = Company::find($id);

        $destination = 'storage/logo/' . $company->logo;

        if (File::exists($destination)) {
            # code...
            File::delete($destination);
        }
        $company->delete();

        Alert::success('Company Deleted Successfully');
        return redirect('/company');  
    }
}
