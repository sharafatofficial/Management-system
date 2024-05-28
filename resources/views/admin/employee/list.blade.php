@extends('admin.app')
@section('content')
<div class="w-100 p-3">
  <div class="container p-4 bg-white" style="max-width:2000px">
    <div class="row pb-3">
        @if(Session::has('msg'))
          <div class="alert alert-danger col-md-12">{{Session::get('msg')}}</div>
        @endif
      <div class="col-12 d-flex justify-content-between align-items-center">
        <h4>Employee Management</h4>
        <a href="{{url('admin/employee/add')}}" class="btn btn-sm btn-primary">Add Employee</a>
      </div>
    </div>
    <div class="row">
      <div class="col-12 overflow-auto">
        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Emp ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Department</th>
              <th style="min-width: 200px">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($employe as $emp)
              <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$emp->emp_id}}</td>
                  <td>{{$emp->name}}</td>
                  <td>{{$emp->email}}</td>
                  <td>
                    @if($emp->user_type == 2)
                      Supervisor
                    @else
                      Employee
                    @endif
                  </td>
                  <td>{{$emp->department}}</td>
                  <td>
                    <a href="{{ route('report-employee',  $emp->id )}}" class="btn btn-sm btn-primary">Report</a>
                    <a href="{{ route('edit-employee',  $emp->id )}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                    <a href="{{route('delete-employee', $emp->id )}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                  </td>
              </tr>
            @endforeach  
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection