<?php

namespace App\Http\Controllers\Admin;

use App\Models\team;
use App\Models\Report;
use App\Models\User;
use App\Models\project;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use Carbon\Carbon;

class AdminMainController extends Controller
{
    public function dashboard(){
      return view('admin.dashboard');
    }

    public function employee(){
      $employe=User::whereIn('user_type', [2,3])->get();
      $data=compact('employe');
      return view('admin.employee.list')->with($data);
    }

    public function add_employee(){
      return view('admin.employee.add');
    }
    public function store_employee(Request $request){
      $input=$request->all();
      // echo '<pre>';
      // return print_r($input);
      $validate=$request->validate([
        'name'=>'required',
        'email'=>'required|unique:users',
        'password'=>'required|min:8',
        'emp_id'=>'required',
        'department'=>'required',
        'user_type'=>'required'
      ]);

      if($validate){
        $table=new User;
        $table->name=$input['name'];
        $table->email=$input['email'];
        $table->password=Hash::make($input['password']);
        $table->emp_id=$input['emp_id'];
        $table->department=$input['department'];
        $table->user_type=$input['user_type'];
        $table->save();
        return redirect('admin/employee/list');

      }
    }
    public function edit_employee($id){
      $employee=User::find($id);
      return view('admin.employee.edit', compact('employee'));
    }
    public function update_employee(Request $request,$id){
      $input=$request->all();   
      $validate=$request->validate([
        'name'=>'required',
        'email'=>'required',
        'emp_id'=>'required',
        'department'=>'required',
        'user_type'=>'required'
      ]);
      if($validate){
        $table=User::find($id);
        $table->name=$input['name'];
        $table->email=$input['email'];
        if(isset($input['password'])){
        $table->password=Hash::make($input['password']);
        }
        else{
          $table->password=$table->password;
        }
        $table->emp_id=$input['emp_id'];
        $table->department=$input['department'];
        $table->user_type=$input['user_type'];
        $table->update();
        return redirect('admin/employee/list');

      }
    }

    
    public function employee_report($id){
      // $report= Report::where('emp_id',$id)->get();
      $report = DB::table('reports')
        ->join('users', 'users.id' ,'reports.emp_id')
        ->join('projects' ,'projects.id' ,'reports.project_id')
        ->select('reports.*','users.name as u_name','projects.name as p_name')
        ->where('users.id' ,$id)
        ->get();
      return view('admin.employee.report', compact('report'));
    }

    public function emp_delete($id){
      User::find($id)->delete();
      return redirect()->back()->with(['msg' => 'Employee deleted successfully']);
    }

    // ------------------------ TEAM -----------------------------------

    public function team(){
      $team=DB::table('teams')->select('teams.*','users.name as u_name')->join('users','users.id','teams.supervisor')->get();
      $data=compact('team');
      return view('admin.team.list')->with($data);
    }
    public function add_team(){
      $supervisor=User::where('user_type',2)->get();
      $employe=User::where('user_type',3)->get();

      return view('admin.team.add', compact('supervisor','employe'));
    }
    public function store_team(Request $request){
      $input=$request->all();
     
     
      $validate=$request->validate([
        'name'=>'required',
        'supervisor'=>'required',
        'employee'=>'required',
      ]);

      if($validate){
        $table=new team;
        $table->name=$input['name'];
        $table->supervisor=$input['supervisor'];
        $emplode=$input['employee'];
        $emolye=implode(',',$emplode);
        $table->employee=$emolye;
        $table->save();
        return redirect('admin/team/list');

      }
    }
    public function edit_team($id){
      $team=team::find($id);
      $supervisor=User::where('user_type',2)->get();
      $employe=User::where('user_type',3)->get();
      return view('admin.team.edit', compact('team','supervisor','employe'));
    }
    public function update_team(Request $request,$id){
      //  echo '<pre>';
      // return print_r($request->all());
      $input=$request->all();   
      $validate=$request->validate([
        'name'=>'required',
        'supervisor'=>'required',
        'employee'=>'required',
      ]);
      if($validate){
        $table= team::find($id);
        $table->name=$input['name'];
        $table->supervisor=$input['supervisor'];
        $emplode=$input['employee'];
        $emolye=implode(',',$emplode);
        $table->employee=$emolye;
        $table->update();
        return redirect('admin/team/list');

      }
    }    
    public function members($id){
      $ids = explode(',', team::where('id', $id)->select('employee')->first()->employee);
      $employe = User::whereIn('id', $ids)->get();
      return view('admin.team.members', compact('employe'));
    }
    public function team_delete($id){
      team::find($id)->delete();
      return redirect()->back()->with(['msg' => 'team deleted successfully']);
    }

    //---------------------------------------------Project--------------------------------------------------


    public function project(){
      $project=project::all();
      $data=compact('project');
      return view('admin.project.list')->with($data);
    }
    public function add_project(){
      return view('admin.project.add');
    }
    public function store_project(Request $request){
      $input=$request->all();
      // echo '<pre>';
      // return print_r($input);
      $validate=$request->validate([
        'name'=>'required',
      ]);

      if($validate){
        $table=new project;
        $table->name=$input['name'];
        $table->save();
        return redirect('admin/project/list');

      }
    }
    public function edit_project($id){
      $project=project::find($id);
      return view('admin.project.edit', compact('project'));
    }
    public function update_project(Request $request,$id){
      $input=$request->all();   
      $validate=$request->validate([
        'name'=>'required',
      ]);
      if($validate){
        $table=project::find($id);
        $table->name=$input['name'];
        $table->update();
        return redirect('admin/project/list');

      }
    }
    public function project_delete($id){
      project::find($id)->delete();
      return redirect()->back()->with(['msg' => 'project deleted successfully']);
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
    return view('admin.report.list')->with($data);
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
      return view('admin.chat.chat');
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
