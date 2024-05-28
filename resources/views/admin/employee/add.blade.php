@extends('admin.app')
@section('content')

<div class="w-100 p-md-3">
  <div class="container p-4 bg-white" style="max-width:2000px">
    <div class="row">
        <div class="col-12">
            <h4>Register Employee</h4>
        </div>
        <div class="col-12 pt-4">
            <form action="{{url('/admin/employee/store')}}" method="post" class="w-100">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name"  class="form-control" placeholder="First Name">	
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
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
                            <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Employee ID</label>
                            <input type="text" name="emp_id"  class="form-control" placeholder="Employee ID">	
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
                                <option value="Frontend">Frontend</option>
                                <option value="Backend">Backend</option>
                                <option value="SEO">SEO</option>
                                <option value="Ghraphic Designing">Ghraphic Designing</option>
                            </select>
                            @if ($errors->has('Department'))
                                <span class="text-danger">{{ $errors->first('Department') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputState">User Type</label>
                            <select class="form-control" name="user_type" aria-label="Default select example">
                                <option value="3">Employee</option>
                                <option value="2">Manager</option>
                            </select>
                            @if ($errors->has('user_type'))
                                <span class="text-danger">{{ $errors->first('user_type') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Register" class="btn btn-sm btn-primary ">
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>




@endsection