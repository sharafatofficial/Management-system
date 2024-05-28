@extends('employee.app')
@section('content')
  <div class="w-100 p-3">
    <div class="container p-4 bg-white" style="max-width:2000px">
      <div class="row pb-3">
          @if(Session::has('msg'))
            <div class="alert alert-danger col-md-12">{{Session::get('msg')}}</div>
          @endif
        <div class="col-12 d-flex justify-content-between align-items-center">
          <h4>Report Management</h4>
          <a href="{{url('employee/report/add')}}" class="btn btn-sm btn-primary">Add Report</a>
        </div>
      </div>
      <div class="row">
        <div class="col-12 overflow-auto">
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th> Report Date</th>
                <th> Report</th>
                <th> Comments</th>
                <th> Status</th>
                <th> Rate</th>
                <th> Project</th>
                <th> Employee</th>
                <th> Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($report as $rep)
                <tr>
                      <td> {{ $loop->iteration}}</td>
                      <td> {{ \Carbon\Carbon::parse($rep->created_at)->format('d F Y')}} </td>
                      <td> {!! $rep->report !!} </td>
                      <td> 
                          @if($rep->comment)
                              {!! $rep->rate !!} 
                          @else 
                              --
                          @endif
                      </td>
                      <td> 
                          @if($rep->status == 0)
                              <p class="btn btn-sm btn-warning" > Pending</p>
                          @elseif($rep->status == 1)
                              <p class="btn btn-sm btn-success" > Approved</p>
                          @elseif($rep->status == 2)
                              <p class="btn btn-sm btn-danger" > Rejected</p>
                          @endif
                          </td>
                      <td> 
                          @if($rep->rate)
                              {{ $rep->rate}} 
                          @else 
                              --
                          @endif
                      </td>
                      <td>{{$rep->p_name}}</td>
                      <td>{{$rep->u_name}}</td>
                      <td>
                          @php 
                          $current = Date('d/m/Y');
                          @endphp 
                          @if($current == \Carbon\Carbon::parse($rep->created_at)->format('d/m/Y'))
                          <a href="{{ route('edit-report',  $rep->id )}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                          @endif
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