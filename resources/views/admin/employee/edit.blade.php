@extends('admin.app')
@section('content')

<div class="w-100 p-md-3">
  <div class="container p-4 bg-white" style="max-width:2000px">
    <div class="row">
        <div class="col-12">
            <h4>Edit Employee</h4>
        </div>
        <div class="col-12 pt-4">
            <form action="{{url('/admin/employee/update/'.$employee->id)}}" method="post" class="w-100">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control"  name="name" value="{{$employee->name}}" placeholder="First Name">	
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" id="email" class="form-control input-sm" value="{{$employee->email}}" placeholder="Email Address">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" id="password" class="form-control input-sm"  placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Employee ID</label>
                            {{$employee->department}}
                            <input type="text" name="emp_id"  class="form-control" value="{{$employee->emp_id}}" placeholder="Employee ID">	
                            @if ($errors->has('emp_id'))
                                <span class="text-danger">{{ $errors->first('emp_id') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputState">Department</label>
                            <select class="form-control" name="department" aria-label="Default select example">
                                <option value="Frontend"{{($employee->department == 'Frontend') ? 'Selected' : ''}}>Frontend</option>
                                <option value="Backend" {{($employee->department == 'Backend') ? 'Selected' : ''}}>Backend</option>
                                <option value="SEO" {{($employee->department == 'SEO') ? 'Selected' : ''}}>SEO</option>
                                <option value="Ghraphic Designing" {{($employee->department == 'Ghraphic Designing') ? 'Selected' : ''}}>Ghraphic Designing</option>
                                

                               
                            </select>	
                            @if ($errors->has('department'))
                                <span class="text-danger">{{ $errors->first('department') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputState">User Type</label>
                            <select class="form-control" name="user_type" aria-label="Default select example">
                                <option value="3" {{($employee->department == '2') ? 'Selected' : ''}}>Employee</option>
                                <option value="2" {{($employee->department == '3') ? 'Selected' : ''}}>Manager</option>
                            </select>
                            
                            @if ($errors->has('user_type'))
                                <span class="text-danger">{{ $errors->first('user_type') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Update" class="btn btn-sm btn-primary ">
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>




@endsection