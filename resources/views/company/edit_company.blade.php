@extends('layouts.app')

@section('content')
<!-- <div class="container"> -->

    <div class="row">

        <div class="col-md-12 pe-4">
            <div class="card">
                <div class="card-header">{{ __('Edit Coumpany') }}
                <a href="/company" class="btn btn-outline-success float-end">All Company</a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <form action="{{ route('company.update', $company->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body pt-4">
                                    <!-- Company Name Field -->
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Company Name</label>
                                        <div class="col-sm-9 mb-3">
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $company->name }}" id="inputName" placeholder="Company Name">
                                            <input type="hidden" name="id" value="{{ old('id') ?? $company->id }}"/>
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
                                        <input type="email" name="email" value="{{ old('email') ?? $company->email }}" class="form-control" id="inputEmail3" placeholder="Company Email">
                                        </div>
                                    </div>
                                    <!-- Company Logo Field -->
                                    <div class="form-group row">
                                        <label for="inputFile" class="col-sm-3 col-form-label">Logo  &nbsp;&nbsp;&nbsp;
                                        <img src="{{asset('/storage/logo/'.$company->logo)}}" class="float-end" width="30" height="30" alt='{{$company->name}}'/>
                                        </label>
                                        <div class="col-sm-9 mb-3">
                                        
                                            <input type="file" name="logo" class="form-control" id="inputFile" placeholder="Logo">
                                        </div>
                                    </div>
                                    <!-- Company Website Field -->
                                    <div class="form-group row">
                                        <label for="inputWebsite" class="col-sm-3 col-form-label">Website</label>
                                        <div class="col-sm-9 mb-4">
                                        <input type="text" name="website" value="{{ old('website') ?? $company->website }}" class="form-control" id="inputWebsite" placeholder="Compamy Website">
                                        </div>
                                    </div><hr/>
                                    <div class="form-group row justify-content-center">
                                        
                                        <div class="col-sm-9 mb-4 justify-content-center">
                                           <center> <button class="btn btn-outline-primary ">Submit</button></center>
                                        </div>
                                    </div>
                                </div>+-
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
