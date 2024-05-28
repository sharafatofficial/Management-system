@extends('admin.app')
@section('content')
  <div class="w-100 p-3">
    <div class="container p-4 bg-white" style="max-width:2000px">
      <div class="row pb-3">
          @if(Session::has('msg'))
            <div class="alert alert-danger col-md-12">{{Session::get('msg')}}</div>
          @endif
        <div class="col-12 d-flex justify-content-between align-items-center">
          <h4>Reports</h4>
          <input type="date" class="form-control w-25" id="date_for_reports" onchange="get_reports()" value="<?php echo date('Y-m-d'); ?>"">
        </div>
      </div>
      <div class="row">
        <div class="col-12 overflow-auto">
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th style="min-width: 130px"> Date</th>
                <th style="min-width: 170px"> Employee</th>
                <th style="min-width: 350px"> Report</th>
                <th style="min-width: 130px"> Project</th>
                <th style="min-width: 350px"> Comments</th>
                <th style="min-width: 130px"> Status</th>
                <th style="min-width: 130px"> Rate</th>
                <!-- <th style="min-width: 130px"> Action</th> -->
              </tr>
            </thead>
            <tbody id="list">
              <tr>
                <td colspan="8"> Loading... </td>
              </tr>
              {{-- @foreach($report as $rep)
                <tr>
                      <td> {{ $loop->iteration}}</td>
                      <td> {{ \Carbon\Carbon::parse($rep->created_at)->format('d F Y')}} </td>
                      <td>{{$rep->u_name}}</td>
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
                      <td>
                          @php 
                          $current = Date('d/m/Y');
                          @endphp 
                          @if($current == \Carbon\Carbon::parse($rep->created_at)->format('d/m/Y'))
                            <a href="{{ route('manager-edit-report',  $rep->id )}}" class="btn btn-sm btn-primary" title="Approve Report"><i class="fa fa-check"></i></a>
                          @endif
                      </td>
                </tr>
              @endforeach  --}}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    function get_reports() {
      let date = $('#date_for_reports').val();
      // alert(date)
      $.get('/admin/reports/'+date, function(res) {
        $("#list").html("")

        if (res.length == 0) {
          $("#list").html('<td colspan="8"> <h6 align="">No Record Found</h6> </td>')
        }

        res.map((row, index)=>{
          if (row.comment == "" || row.comment == null) {
            row.comment  = '--';
          }

          if (row.status == 0) {
            row.status = '<p class="btn btn-sm btn-warning" > Pending</p>';
          }else if(row.status == 1){
            row.status  = '<p class="btn btn-sm btn-success" > Approved</p>';
          }else if(row.status == 2){
            row.status  = '<p class="btn btn-sm btn-danger" > Rejected</p>'
          }else{
            row.status = "--";
          }

          if(row.rate == null || row.rate == ''){
            row.rate = "--";
          }
          $("#list").append(`
            <tr>
              <td>${index+1}</td>
              <td> {{ \Carbon\Carbon::parse(`+ row.created_at1 + `)->format('d F Y')}} </td>
              <td> ${row.u_name}</td>
              <td> ${row.report} </td>
              <td> ${row.p_name} </td>
              <td> ${row.comment} </td>
              <td> ${row.status} </td>
              <td> ${row.rate} </td>
              </tr>
              `);
        });
      });
    }get_reports();
  </script>
@endpush