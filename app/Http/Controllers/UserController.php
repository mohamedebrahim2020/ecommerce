<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],//. auth()->user()->id,
            'email' => ['required', 'string', 'email', 'max:255'],// 'unique:users'],
            'phone'=> ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
        $profile = auth()->user()->find($id);
        $profile->name = $request->input('name');
        $profile->email = $request->input('email');
        $profile->phone = $request->input('phone');
        $profile->password  = bcrypt($request->get('password'));
        $profile->save();
        return redirect()->to('/myaccount')->with('message', 'Your account information has been updated. Thank you!');
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
    }

    // for admin

    public function adminUsers()
    {   
        $users = User::paginate(3);
        
        return view('layouts.AdminPanel.user.userstable', ['users' => $users]);
    }
    public function ban(Request $request, $id)
    {
        $user = User::find($id);
        if (!empty($user)) {

            $user->bans()->create([
                'expired_at' => '+1 month'
            ]);
        }
        return redirect('/admin/panel/userstable')->with('success', 'Ban Successfully..');
    }

    public function revoke($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            $user->unban();
        }
        return redirect('/admin/panel/userstable')
            ->with('success', 'User Revoke Successfully.');
    }
     

    public function showuser($id)
    {
        $user = User::find($id);
        return view('layouts.AdminPanel.user.show', ['user' => $user]);
    }
    public function editUser($id)
    {
        $user = User::find($id);
        return view('layouts.AdminPanel.user.edit', ['user' => $user]);
    }

    public function updateUser(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'email|unique:users,email,' . auth()->user()->id,
        ]);
        $user = User::find($id);
        $user->name = request()->name;
        $user->email = request()->email;
        $user->phone = request()->phone;
        $user->save();
        return redirect('/admin/panel/userstable');
    }

    public function destroyUser($id)
    {
        User::find($id)->delete();
        return redirect('/admin/panel/userstable');
    }
}
