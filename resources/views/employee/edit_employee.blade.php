@extends('layouts.app')

@section('content')
<!-- <div class="container"> -->

    <div class="row">

        <div class="col-md-12 pe-4">
            <div class="card">
                <div class="card-header">{{ __('Edit Employee') }}
                <a href="/employee" class="btn btn-outline-success float-end">All Employees</a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <form action="{{ route('employee.update', $employee->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body pt-4">
                                    <!-- Employee First Name Field -->
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9 mb-3">
                                             <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $employee->name }}" id="inputName" placeholder="Name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                             @enderror
                                        </div>
                                    </div>

                                    <!-- Company Email Field -->
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9 mb-3">
                                            <input type="email" name="email" value="{{ old('email') ?? $employee->email }}" class="form-control" id="inputEmail3" placeholder="Employee Email">
                                        </div>
                                    </div>
                                    <!-- Employ DOB Field -->
                                    <div class="form-group row">
                                        <label for="inputDOB" class="col-sm-3 col-form-label">Phone</label>
                                        <div class="col-sm-9 mb-3">
                                            <input type="date" name="dob" value="{{ old('dob') ?? $employee->dob }}" class="form-control"  id="inputDOB" placeholder="DOB">
                                        </div>

                                    </div>
                                    <!-- Employ Phone Field -->
                                    <div class="form-group row">
                                        <label for="inputPhone" class="col-sm-3 col-form-label">Phone</label>
                                        <div class="col-sm-9 mb-3">
                                            <input type="text" name="phone" value="{{ old('phone') ?? $employee->phone  }}" class="form-control"  id="inputPhone" placeholder="Phone">
                                        </div>

                                    </div>
                                    <!-- Employ Adress Field -->
                                    <div class="form-group row">
                                        <label for="inputAdress" class="col-sm-3 col-form-label">Phone</label>
                                        <div class="col-sm-9 mb-3">
                                            <input type="text" name="address" value="{{ old('address') ?? $employee->address  }}" class="form-control"  id="inputAdress" placeholder="Adress">
                                        </div>

                                    </div>                                   
                                      <!-- Employee Department Field -->
                                    <div class="form-group row">
                                        <label for="inputDepartment" class="col-sm-3 col-form-label">Department</label>
                                        <div class="col-sm-9 mb-3">
                                            <input type="text" name="department" class="form-control @error('department') is-invalid @enderror" value="{{ old('department') ?? $employee->department  }}" id="inputDepartment" placeholder="Department">
                                            @error('department')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                             @enderror
                                        </div>
                                    </div>   <hr/>
                                    <div class="form-group row">                        
                                        <div class="col-sm-9 mb-4">
                                           <center> <button class="btn btn-outline-primary ">Update</button></center>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
@endsection
