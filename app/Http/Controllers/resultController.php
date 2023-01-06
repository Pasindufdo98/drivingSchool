<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class resultController extends Controller

{
    public function index()
    {
        $user_results = DB::table('exam_results')
                ->join('students','students.user_id','=','exam_results.user_id')
                ->join('users','users.id','=','students.user_id')
                ->select('exam_results.*','users.name','students.user_id')
            
                ->paginate(5);

                return view('admin.results.index',compact('user_results'))->with('i',(request()->input('page',1) - 1) * 5);
                    

                    
    }

    public function create()
    {
        //$all_users_with_all_their_roles = User::with('roles')->get();
        //$users = User::all();
        // $user_roles = [];
        // $user_students = [];
        // $student = [];

        // foreach ($users as $user) {

        // $user_roles=$user->getRoleNames();
            
        //   if($user_roles[0] == "student"){

        //     $user_students[] = User::find($user->id)->student;
        //     $duser[] = User::find($user->id);
        //   }
        // }
       
        return view('admin.results.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
    {
        
        
        // request()->validate([
        //     'name'=> 'required',
        //     'email'=> 'required',
        //     'phone'=> 'required',
        //     'password' => 'required|min:8|confirmed',
        //     'file' => 'required',
        // ]);
        // dd($request);
        $result = new examResult;
 
        $result->user_id = $request->user_id;
        $result->TResult = $request->TResult;
        $result->PResult = $request->PResult;
        

        $result->save();

        // $student = new Student;
        // $student->contact = $request->contact;
        // $student->address = $request->address;
        // $student->classA = $request->classA;
        // $student->classA_transmission = $request->classA_transmission;
        // $student->classB = $request->classB;
        // $student->classB_transmission = $request->classB_transmission;
        // $student->classB1 = $request->classB1;
        // $student->classCE = $request->classCE;
        // $student->nic = $request->nic;
        // $student->bloodGroup = $request->bloodGroup;

        // if($request->hasFile('file')) {
        // $imageName = time().'.'.$request->file->extension();  
       
        // $request->file->move(public_path('images'), $imageName);

        // $student->photo_path = $imageName;
            
        // }  
        
        // $user->student()->save($student);

        // $user->assignRole('student');
    
        return redirect()->route('results.create')
                        ->with('success','Results created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $student=Student::find($id);
        $suser=$student->user;

        return view('admin.students.show',compact('student','suser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $result=examResults::find($id);
       
        
        return view('admin.students.edit',compact('results'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // request()->validate([
        //     'name'=> 'required',
        //     'email'=> 'required',
        //     'contact'=> 'required',
           
            
        // ]);
  
        $result = examResult::find($id);
        
        $result->TResult = $request->TResult;
        $result->PResult = $request->PResult;
        
        

        $result->update();

        // $student = new student;
        
        // $student->contact = $request->contact;
        // $student->address = $request->address;
        // $student->classA = $request->classA;
        // $student->classA_transmission = $request->classA_transmission;
        // $student->classB = $request->classB;
        // $student->classB_transmission = $request->classB_transmission;
        // $student->classB1 = $request->classB1;
        // $student->classCE = $request->classCE;
        // $student->nic = $request->nic;
        // $student->bloodGroup = $request->bloodGroup;

        
        // if($request->hasFile('file')) {
        // $imageName = time().'.'.$request->file->extension();  
       
        // $request->file->move(public_path('images'), $imageName);

        // $student->photo_path = $imageName;
        // }
        
        // $user->student()->update($student->toArray());

        // // DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        // // $user->assignRole($request->input('roles'));
    
        return redirect()->route('students.index')
                        ->with('success','student created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        $user = User::find($id);
        
        $user->student()->delete();
        $user->delete();

        return redirect()->route('students.index')
        ->with('success','student deleted successfully');
        
    }
    
}
