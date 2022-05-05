@extends('layouts.app')

@section('content')
<!-- <div class="container"> -->

    <div class="row">

        <div class="col-md-a2 pe-4">
            <div class="card">
                <div class="card-header">{{ __('Companies List') }}
                <a href="/company/create" class="btn btn-outline-success float-end">Add Company</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-stripe table-hover">
                        <thead>
                            <tr>
                                <td>#id</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Logo</td>
                                <td>Website</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td>#{{$company->id}}</td>
                                    <td>{{$company->name}}</td>
                                    <td>{{$company->email}}</td>
                                    <td><img src="{{asset('/storage/logo/'.$company->logo)}}" width="100" height="100" alt='{{$company->name}}'/></td>
                                    <td>{{$company->website}}</td>
                                    <td>
                                        <a href="{{ route('company.edit', $company->id) }}"><i class="fa fa-edit text-primary fs-4" title="Edit"></i></a>&nbsp | &nbsp
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                            <i class="fas fa-trash text-danger fs-4" title="Delete"></i>
                                        </a>
                                        <form id="delete-form" action="{{ route('company.destroy', $company->id) }}" method="post" class="d-none">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                                <tr>
                                    <td>#id</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Logo</td>
                                    <td>Website</td>
                                    <td>Action</td>
                                </tr>                            
                        </tfoot>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="fs-6">Showing[ {{ $companies->firstItem() }}  -  {{ $companies->lastItem() }} ]  of  {{ $companies->total() }} results</span>
                            <span class="float-end">{{ $companies->links() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
@endsection
