<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use Hash;
use DB;
use App\sim;
use App\reload;
use App\rd;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin) {
            $users = DB::table('users')
                        ->where('admin', '=', 0)
                        ->orderBy('created_at', 'DESC')
                        ->paginate(20);

            return view('users.index', compact('users'));
        }
        else {
            return redirect('/home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->admin) {
            return view('users.create');
        }
        else {
            return redirect('/home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->admin) {

            $validatedData = $request->validate([
                'name' => 'required:max:40',
                'email' => 'required|unique:users|max:190',
                'password' => 'required|min:8',
                
            ]);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->admin = $request->role;
            $user->status = $request->permission;
            $user->password = Hash::make($request->password);
            $user->save();

            // $role = new Role;
            // $role->user_id = $user->id;
            // $role->permission = $request->permission;
            // $role->save();

            return redirect('/admin-panel')->with('msg_success', 'User Created Successfully');
            
        }
        else {
            return redirect('/home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->admin) {
            $user = User::find($id);
            return view('users.view', compact('user'));
        }
        else {
            return redirect('/home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->admin) {
            $user = User::findOrFail($id);
            $user_role = DB::table('roles')->where('user_id', '=', $id)->first();
            return view('users.edit', compact('user', 'user_role'));

        }
        else {
            return redirect('/home');
        }
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
        if(Auth::user()->admin) {
            $validatedData = $request->validate([
                'name' => 'required:max:40',
                'email' => 'required|max:190',
                'password' => 'nullable|min:8',
            ]);

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->status = $request->permission;
            if($user->password) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect('/admin-panel')->with('msg_success', 'User Updated Successfully');
        }
        else {
            return redirect('/home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->admin) {
            $user = User::find($id);
            $role = Role::where('user_id', '=', $id)->firstOrFail();
            $role->delete();
            $user->delete();
            return redirect('/admin-panel')->with('msg_success', 'User Deleted Successfully');
        }
        else {
            return redirect('/home');
        }
    }
    public function rddetails()
    {
        if(Auth::user()->admin) {
            $users = rd::leftJoin('users', 'rds.user_id', '=', 'users.id')
            ->select('rds.*', 'users.name')
            ->get();

            return view('users.rddetails', compact('users'));
        }
        else {
            return redirect('/home');
        }
    }
    public function reloaddetails()
    {
        if(Auth::user()->admin) {
            $users = reload::leftJoin('users', 'reloads.user_id', '=', 'users.id')
            ->select('reloads.*', 'users.name')
            ->get();

            return view('users.reloaddetails', compact('users'));
        }
        else {
            return redirect('/home');
        }
    }
    public function reloaddetailsedit($id)
    {
        // dd($id);
        if(Auth::user()->admin) {
            $user = user::findOrFail($id);
            $user_rddetails = reload::where('user_id', '=', $id)->first();
            return view('users.reloaddetailsedit', compact('user', 'user_rddetails'));

        }
        else {
            return redirect('/home');
        }
    }
    public function updatereloaddetails(Request $request, $id){
        if(Auth::user()->admin) {
            $validatedData = $request->validate([
                'name' => 'required',
                'target' => 'required',
                'achivement' => 'required',
                'days' => 'required',
            ]);
            // dd($id);

            $user = reload::where('user_id',$id)->first();
            // dd($user);
            $user->days = $request->days;
            $user->target = $request->target;
            $user->achivement = $request->achivement;

            $user->save();

            return redirect('users/reloaddetails/change/'.$id)->with('msg_success', 'Database Updated Successfully');
        }
        else {
            return redirect('/home');
        }
    }


    public function simdetailsedit($id)
    {
        // dd($id);
        if(Auth::user()->admin) {
            $user = user::findOrFail($id);
            $user_rddetails = sim::where('user_id', '=', $id)->first();
            return view('users.simdetailsedit', compact('user', 'user_rddetails'));

        }
        else {
            return redirect('/home');
        }
    }
    public function updatesimdetails(Request $request, $id){
        if(Auth::user()->admin) {
            $validatedData = $request->validate([
                'name' => 'required',
                'target' => 'required',
                'achivement' => 'required',
                'days' => 'required',
            ]);
            // dd($id);

            $user = sim::where('user_id',$id)->first();
            // dd($user);
            $user->days = $request->days;
            $user->target = $request->target;
            $user->achivement = $request->achivement;

            $user->save();

            return redirect('/users/simdetails/change/'.$id)->with('msg_success', 'Database Updated Successfully');
        }
        else {
            return redirect('/home');
        }
    }




    public function simdetails()
    {
        if(Auth::user()->admin) {
            $users = sim::leftJoin('users', 'sims.user_id', '=', 'users.id')
            ->select('sims.*', 'users.name')
            ->get();

            return view('users.simdetails', compact('users'));
        }
        else {
            return redirect('/home');
        }
    }

    public function rddetailsedit($id)
    {
        // dd($id);
        if(Auth::user()->admin) {
            $user = user::findOrFail($id);
            $user_rddetails = rd::where('user_id', '=', $id)->first();
            return view('users.rddetailsedit', compact('user', 'user_rddetails'));

        }
        else {
            return redirect('/home');
        }
    }

    public function updaterddetails(Request $request, $id){
        if(Auth::user()->admin) {
            $validatedData = $request->validate([
                'name' => 'required',
                'target' => 'required',
                'achivement' => 'required',
                'days' => 'required',
            ]);
            // dd($id);

            $user = rd::where('user_id',$id)->first();
            // dd($user);
            $user->days = $request->days;
            $user->target = $request->target;
            $user->achivement = $request->achivement;

            $user->save();

            return redirect('users/rddetails/change/'.$id)->with('msg_success', 'Database Updated Successfully');
        }
        else {
            return redirect('/home');
        }
    }


}
