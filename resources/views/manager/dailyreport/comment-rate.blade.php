@extends('manager.app')
@section('content')

<div class="w-100 p-md-3">
  <div class="container p-4 bg-white" style="max-width:2000px">
    <div class="row">
        <div class="col-12">
            <h4>Rate & Comment</h4>
        </div>
        <div class="col-12 pt-4">
            <form action="{{url('/manager/report/rate-commment/'.$id)}}" method="post" class="w-100">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputState">Rating</label>
                            <select class="form-control" name="rate" aria-label="Default select example">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="0">9</option>
                                <option value="10">10</option>
                               
                            </select>
                            @if ($errors->has('Department'))
                                <span class="text-danger">{{ $errors->first('Department') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputState">Commment</label>
                            <input type="text" name="comment" class="form-control">
                            @if ($errors->has('user_type'))
                                <span class="comment">{{ $errors->first('comment') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Save" class="btn btn-sm btn-primary ">
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>


@endsection