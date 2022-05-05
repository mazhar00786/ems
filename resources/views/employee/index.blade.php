@extends('layouts.app')

@section('content')
<!-- <div class="container"> -->

    <div class="row">
        <div class="col-md-3">
 
        </div>
        <div class="col-md-12 pe-4">
            <div class="card">
                <div class="card-header">{{ __('Employees List') }}
                    <a href="/employee/create" class="btn btn-outline-success float-end">Add Employee</a>
                </div>
                <div class="card-body">
                    <!-- <div class="card-body"> -->
                        <table class="table table-bordered table-stripe table-hover">
                            <thead>
                                <tr>
                                    <td>#id</td>
                                    <td>Name</td>
                                    <td>Company</td>
                                    <td>Email</td>                                   
                                    <td>Phone</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                <tr>
                                    <td>#{{$employee->id}}</td>
                                    <td>{{ $employee->first_name }}  {{ $employee->last_name }}</td>
                                    <td>{{ $employee->company->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>
                                        <a href="{{ route('employee.edit', $employee->id) }}"><i class="fa fa-edit text-primary fs-4" title="Edit"></i></a>&nbsp | &nbsp
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                            <i class="fas fa-trash text-danger fs-4" title="Delete"></i>
                                        </a>
                                        <form id="delete-form" action="{{ route('employee.destroy', $employee->id) }}" method="post" class="d-none">
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
                                <span class="fs-6">Showing[ {{ $employees->firstItem() }}  -  {{ $employees->lastItem() }} ]  of  {{ $employees->total() }} results</span>
                                <span class="float-end">{{ $employees->links() }}</span>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
@endsection
