@extends('employee.app')
@section('content')
    <div class="w-100 p-md-3">
        <div class="container p-4 bg-white" style="max-width:2000px">
            <div class="row">
                <div class="col-12">
                    <h4>Add Report</h4>
                </div>
                <div class="col-12 pt-4">
                    <form action="{{url('/employee/report/update/'.$report->id)}}" method="post" class="w-100">
                        @csrf
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputState">Project</label>
                                    <select class="form-control" name="project_id" aria-label="Default select example">
                                        @foreach($project as $val)
                                        <option value="{{$val->id}}"{{($val->id==$report->project_id) ? 'Selected' : '' }}>{{$val->name}}</option>
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
                                    <textarea name="report" id="" class="form-control" cols="" rows="2">{{$report->report}}</textarea>
                                    @if ($errors->has('report'))
                                        <span class="text-danger">{{ $errors->first('report') }}</span>
                                    @endif
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
@push('scripts')
    <script>
        tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ]
        });
    </script>
@endpush