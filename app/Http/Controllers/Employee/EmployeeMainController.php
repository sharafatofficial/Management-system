<?php

  namespace App\Http\Controllers\Employee;
  use App\Models\Report;
  use App\Models\project;
  use App\Models\Message;
  use Illuminate\Http\Request;
  use Carbon\Carbon;
  use App\Models\User;
  use DB;
  use App\Http\Controllers\Controller;
  use Auth;

  class EmployeeMainController extends Controller{
    public function dashboard(){
        return view('employee.dashboard');
    }

    public function report(){
        $auth =   Auth::id();
        $report = DB::table('reports')
        ->join('users', 'users.id' ,'reports.emp_id')
        ->join('projects' ,'projects.id' ,'reports.project_id')
        ->select('reports.*','users.name as u_name','projects.name as p_name')
        ->where('users.id' ,$auth)
        ->get();
        return view('employee.report.list', compact('report'));
    }

    public function add_report(){
        $project=project::all();
        return view('employee.report.add',Compact('project'));
    }

    public function store_report(Request $request){
        $input      = $request->all();
        $validate   = $request->validate([
          'project_id'  => 'required',
          'report'      => 'required',
        ]);
        if($validate){
          $new_report = new Report;
          $new_report->emp_id     = Auth::id();
          $new_report->project_id = $input['project_id'];
          $new_report->report     = $input['report'];
          $new_report->save();
          return redirect('employee/report/list');
        }
    }
    
    public function edit_report($id){
        $project = project::all();
        $report  = Report::find($id);
        $current = Date('d/m/Y');

        if (Carbon::parse($report->created_at)->format('d/m/Y') != $current) {
          return redirect('employee/report/list');
        }
        
        return view('employee.report.edit', compact('report', 'project'));
    }

    public function update_report(Request $request,$id){
        $input=$request->all();   
        $validate=$request->validate([
            'project_id'=>'required',
            'report'=>'required',
        ]);
        if($validate){
          $table= Report::find($id);
          $table->emp_id=Auth::id();
          $table->project_id=$input['project_id'];
          $table->report=$input['report'];
          $table->update();
          return redirect('employee/report/list');
        }
    }


    // ----------------------------------------------------- CHAT -------------------------------------------

    public function chat(){
      return view('employee.chat.chat');
    }
    public function get_contacts(){
      try {
        $auth =   Auth::id();
        $users = User::whereNot('id', $auth)->get();
        foreach ($users as  $user) {
          $user->message_count = Message::where('receiver_id', $auth)->where('sender_id', $user->id)->where('sceen', 0)->count();
        }
        return response()->json($users, 200);
      } catch (\Exception $ex) {
        return response()->json($ex->getMessage(), 200);
      }
      
    }
  
  
    public function get_messages($id){
      try {
        $auth     = Auth::id();
  
        Message::where('sender_id', $id)
          ->where('receiver_id', $auth)
          ->update(['sceen' => 1]);
        $messages = Message::where(function ($query) use ($auth, $id) {
                        $query->where('sender_id', $auth)
                              ->where('receiver_id', $id);
                    })->orWhere(function ($query) use ($auth, $id) {
                        $query->where('sender_id', $id)
                              ->where('receiver_id', $auth);
                    })->get();
  
        
        return response()->json($messages, 200);
      } catch (\Exception $ex) {
        return response()->json($ex->getMessage(), 200);
      }
    }
  
  
    public function send_messages(Request $req){
      try {
        $message = new Message;
        $message->sender_id = Auth::id();
        $message->receiver_id = $req->id;
        $message->message = $req->message;
        $message->save();
        return response()->json('Successfully Added', 200);
      } catch (\Exception $ex) {
        return response()->json($ex->getMessage(), 200);
      }
    }
  }
