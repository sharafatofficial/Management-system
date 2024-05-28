@extends('employee.app')
@section('content')

<div class="w-100 p-md-3">
  <div class="container p-4 bg-white" style="max-width:2000px">
    <div class="row">
        <div class="col-12">
            <h4>Add Report</h4>
        </div>
        <div class="col-12 pt-4">
            <form action="{{url('/employee/report/store')}}" method="post" class="w-100">
                @csrf
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputState">Project</label>
                            <select class="form-control" name="project_id" aria-label="Default select example">
                                @foreach($project as $val)
                                <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('project_id'))
                                <span class="text-danger">{{ $errors->first('project_id') }}</span>
                            @endif
                        </div>
                    </div>
                   
                </div>
           
                <div class="row">
                    <div class="col-12">
                    <div class="form-group">
                            <label for="exampleInputEmail1">Report</label>
                            <textarea name="report" id="" class="form-control" cols="" rows="2"></textarea>
                            @if ($errors->has('report'))
                                <span class="text-danger">{{ $errors->first('report') }}</span>
                            @endif
                        </div>
                    </div>                   
                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Submit" class="btn btn-sm btn-primary ">
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>




@endsection