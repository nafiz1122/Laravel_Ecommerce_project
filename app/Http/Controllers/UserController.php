<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.userList',compact('users'));
    }
    public function add()
    {
        return view('admin.user.addUser');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:users|max:25',
            'email' => 'required|unique:users|max:25',
            'password' => 'required|:users|min:8',
        ]);
        $user = new User;
        $user->role_type = $request->role_type;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =bcrypt($request->password);

        $user->save();

        return redirect()->route('user.list')->with('message', 'User Added!');;
    }

    public function edit($id)
    {
        $users = User::find($id);
        return view('admin.user.editUser',compact('users'));
    }

    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:25',
            'email' => 'required|max:35',
        ]);
        $user = User::find($id);
        $user->role_type = $request->role_type;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        return redirect()->route('user.list')->with('message', 'User Updated!');
    }
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.list')->with('message', 'User Delete Successfully!');
    }
}
