<?php

namespace App\Http\Controllers\Manager;

use App\Models\project;
use App\Models\Report;
use App\Models\User;
use App\Models\Message;
use Carbon\Carbon;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerMainController extends Controller
{
    public function dashboard(){
        return view('manager.dashboard');
    }
    
    public function report(){
        $auth=Auth::id();
        $report=DB::table('reports')->select('reports.*','users.name as u_name','projects.name as p_name')
        ->join('users','reports.emp_id','users.id' )
        ->join('projects','reports.project_id','projects.id')->where('users.id',$auth)->get();
        $data=compact('report');
        return view('manager.report.list')->with($data);
    }

    public function add_report(){
        $project=project::all();
        return view('manager.report.add',Compact('project'));
    }
    public function store_report(Request $request){
        
        $input=$request->all();
        $validate=$request->validate([
          'project_id'=>'required',
          'report'=>'required',
        ]);
  
        if($validate){
          $table=new Report;
          $table->emp_id=Auth::id();
          $table->project_id=$input['project_id'];
          $table->report=$input['report'];
          $table->save();
          return redirect('manager/report/list');
  
        }
    }
    public function edit_report($id){
        $project=project::all();
        $report=report::find($id);
        $current = Date('d/m/Y');
        if (Carbon::parse($report->created_at)->format('d/m/Y') != $current) {
          return redirect('manager/report/list');
        }
        return view('manager.report.edit', compact('report', 'project'));
    }
    public function update_report(Request $request,$id){
        $input=$request->all();   
        $validate=$request->validate([
            'project_id'=>'required',
            'report'=>'required',
        ]);
        if($validate){
          $table=report::find($id);
          $table->emp_id=Auth::id();
          $table->project_id=$input['project_id'];
          $table->report=$input['report'];
          $table->update();
          return redirect('manager/report/list');
        }
    }

  // -----------------------------------------------------Daily Report-------------------------------------------
  public function daily_report($date = null){
    if ($date == null) {
      $date = Date('Y/m/d');
    }
    // 20-12-2023
    $date = Carbon::parse($date)->format('Y/m/d');
    // return $date;
    
    $report=DB::table('reports')->select('reports.*','users.name as u_name','projects.name as p_name')
    ->join('users','reports.emp_id','users.id' )
    ->join('projects','reports.project_id','projects.id')->whereDate('reports.created_at',$date)->get();
    $data=compact('report');
    return view('manager.dailyreport.list')->with($data);
  }

  public function reports($date = null){
    if ($date == null) {
      $date = Date('Y/m/d');
    }
    // 20-12-2023
    $date = Carbon::parse($date)->format('Y/m/d');
    $report=DB::table('reports')->select('reports.*','users.name as u_name','projects.name as p_name')
    ->join('users','reports.emp_id','users.id' )
    ->join('projects','reports.project_id','projects.id')->whereDate('reports.created_at',$date)->get();
    return response()->json($report, 200);
  }

  // ----------------------------------------------------- CHAT -------------------------------------------

  public function chat(){
    return view('manager.chat.chat');
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
  
// -----------------------------------------------------------------update status-------------------------


  public function approve_report($id){
    $table=Report::find($id);
    $table->status=1;
    $table->update();
    return redirect('manager/report/daily');
  }

  public function reject_report($id){
    $table=Report::find($id);
    $table->status=2;
    $table->update();
    return redirect('manager/report/daily');
  }

  public function rate_comment_report($id){
    return view('manager.dailyreport.comment-rate',compact('id'));
  }

  public function rate_comment(Request $req,$id){
    $table=Report::find($id);
    $table->rate=$req['rate'];
    $table->comment=$req['comment'];
    $table->update();
    return redirect('manager/report/daily');
  }


}
