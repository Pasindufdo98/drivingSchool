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

class StudentController extends Controller
{
    public function index()
    {
        $user_students = DB::table('users')
                ->join('students','users.id','=','students.user_id')
                ->select('users.*','students.*')
                
                ->paginate(5);

                return view('admin.students.index',compact('user_students'))
                    ->with('i',(request()->input('page',1) - 1) * 5);

                    
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
       
        return view('admin.students.create');
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
        $user = new User;
 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        $student = new Student;
        $student->contact = $request->contact;
        $student->address = $request->address;
        $student->classA = $request->classA;
        $student->classA_transmission = $request->classA_transmission;
        $student->classB = $request->classB;
        $student->classB_transmission = $request->classB_transmission;
        $student->classB1 = $request->classB1;
        $student->classCE = $request->classCE;
        $student->nic = $request->nic;
        $student->bloodGroup = $request->bloodGroup;

        // if($request->hasFile('file')) {
        // $imageName = time().'.'.$request->file->extension();  
       
        // $request->file->move(public_path('images'), $imageName);

        // $student->photo_path = $imageName;
            
        // }  
        
        $user->student()->save($student);

        $user->assignRole('student');
    
        return redirect()->route('students.create')
                        ->with('success','Student created successfully.');
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
        $student=Student::find($id);
       $suser=$student->user;
        
        return view('admin.students.edit',compact('student'));
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
  
        $user = User::find($id);
        
        $user->name = $request->name;
        $user->email = $request->email;
        
        if(!empty($request->password)){ 
            $user->password = Hash::make($request->password);
        }else{
            $user = Arr::except($user, ['password']);
            
        }

        $user->update();

        $student = new student;
        
        $student->contact = $request->contact;
        $student->address = $request->address;
        $student->classA = $request->classA;
        $student->classA_transmission = $request->classA_transmission;
        $student->classB = $request->classB;
        $student->classB_transmission = $request->classB_transmission;
        $student->classB1 = $request->classB1;
        $student->classCE = $request->classCE;
        $student->nic = $request->nic;
        $student->bloodGroup = $request->bloodGroup;

        
        if($request->hasFile('file')) {
        $imageName = time().'.'.$request->file->extension();  
       
        $request->file->move(public_path('images'), $imageName);

        $student->photo_path = $imageName;
        }
        
        $user->student()->update($student->toArray());

        // DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        // $user->assignRole($request->input('roles'));
    
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
