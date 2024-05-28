@extends('admin.app')
@section('content')

<div class="w-100 p-md-3">
  <div class="container p-4 bg-white" style="max-width:2000px">
    <div class="row">
        <div class="col-12">
            <h4>CREATE TEAM </h4>

             

        </div>
        <div class="col-12 pt-4">
            <form action="{{url('admin/team/store')}}" method="post" class="w-100">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Team Name</label>
                            <input type="text" name="name"  class="form-control" placeholder="First Name">	
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputState">Supervisor</label>
                            <select class="form-control" name="supervisor" aria-label="Default select example">
                                @foreach($supervisor as $super)
                                <option value="{{$super->id}}">{{$super->name}}</option> 
                                @endforeach 
                            </select>
                            @if ($errors->has('supervisor'))
                                <span class="text-danger">{{ $errors->first('supervisor') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputState">Employees</label>
                            <select class="form-control" name="employee[]" multiple>
                                @foreach($employe as $emp)
                                    <option value="{{$emp->id}}">{{$emp->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('employee'))
                                <span class="text-danger">{{ $errors->first('employee') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Create " class="btn btn-sm btn-primary ">
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>




@endsection