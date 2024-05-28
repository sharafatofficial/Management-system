@extends('admin.app')
@section('content')
<div class="w-100 p-3">
  <div class="container p-4 bg-white" style="max-width:2000px">
    <div class="row pb-3">
        @if(Session::has('msg'))
         <div class="alert alert-danger col-md-12">{{Session::get('msg')}}</div>
        @endif
      <div class="col-12 d-flex justify-content-between align-items-center">
        <h4>Team Management</h4>
        <a href="{{url('admin/team/add')}}" class="btn btn-sm btn-primary">Add Team</a>
      </div>
    </div>
    <div class="row">
      <div class="col-12 overflow-auto">
        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Team Name</th>
              <th>TEAM SUPERVISOR</th>
              <th>TOTAL MEMBERS</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($team as $emp)
              <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$emp->name}}</td>
                  <td>{{$emp->u_name}}</td>
                  <td>
                    @php 
                      echo count(explode(',', $emp->employee))
                    @endphp
                  </td>
                  <td>
                    <a href="{{ route('team-members',  $emp->id )}}" class="btn btn-sm btn-primary">List Members</a>
                    <a href="{{ route('edit-team',  $emp->id )}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                    <a href="{{route('delete-team', $emp->id )}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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