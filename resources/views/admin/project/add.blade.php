@extends('admin.app')
@section('content')

<div class="w-100 p-md-3">
  <div class="container p-4 bg-white" style="max-width:2000px">
    <div class="row">
        <div class="col-12">
            <h4>Add Project</h4>
        </div>
        <div class="col-12 pt-4">
            <form action="{{url('/admin/project/store')}}" method="post" class="w-100">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Project Name</label>
                            <input type="text" name="name"  class="form-control" placeholder="Project Name">	
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
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