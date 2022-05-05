@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="/home">{{ __('Dashboard') }}</a>
                        <a href="/employee/create" class="btn btn-outline-success float-end">Add Employee</a>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <form action="{{ url('/search') }}" method="POST" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" placeholder="Search for"><span
                                        class="input-group-btn">
                                        <button type="submit" class="btn btn-info">
                                            <i class="fas fa-search fa-sm"></i> Search
                                        </button>
                                    </span>

                                </div>
                            </form>
                        </div>
                        <table class="table table-bordered table-stripe table-hover">
                            <thead>
                                <tr>
                                    <td>#id</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>DOB</td>
                                    <td>Phone</td>
                                    <td>address</td>
                                    <td>Department</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>#{{ $employee->id }}</td>
                                        <td>{{ $employee->name }} {{ $employee->last_name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->dob }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->address }}</td>

                                        <td>{{ $employee->department }}</td>
                                        <td>
                                            <a href="{{ route('employee.edit', $employee->id) }}"><i
                                                    class="fa fa-edit text-primary fs-4" title="Edit"></i></a>&nbsp | &nbsp
                                            <a href="#"
                                                onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                                <i class="fas fa-trash text-danger fs-4" title="Delete"></i>
                                            </a>
                                            <form id="delete-form"
                                                action="{{ route('employee.destroy', $employee->id) }}" method="post"
                                                class="d-none">
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
                                    <td>DOB</td>
                                    <td>Phone</td>
                                    <td>address</td>
                                    <td>Department</td>
                                    <td>Action</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="fs-6">Showing[ {{ $employees->firstItem() }} -
                                    {{ $employees->lastItem() }} ] of {{ $employees->total() }} results</span>
                                <span class="float-end">{{ $employees->links() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('search') }}',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
@endpush
