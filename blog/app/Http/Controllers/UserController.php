<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use Session;

class UserController extends Controller
{
    function register(Request $request){
        $user = new UserModel();

        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required'
        ]);

        $firstname = $request->input('f_name');
        $lastname = $request->input('l_name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');

        if($password != $confirm_password){
            return back()->with('fail', 'Please confirm right password');
        } else{
            $password = Hash::make($password);
            $chkemail = UserModel::where('email','=',$email)->first();
            if($chkemail == true){
                return back()->with('fail', 'Email address is not available');
            } else{
                $user->firstname = $firstname;
                $user->lastname = $lastname;
                $user->email = $email;
                $user->phone = $phone;
                $user->password = $password;

                $result = $user->save();
                if($result){
                    return back()->with('success', 'Registration completed successfully');
                } else{
                    return back()->with('fail', 'Something went wrong!');
                }
            }
        }
    }

    function login(Request $request){
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $chkemail = UserModel::where('email','=',$email)->first();
        if($chkemail == false){
            return back()->with('fail', 'Email address not exist');
        } else{
            if(Hash::check($password, $chkemail->password) == false){
                return back()->with('fail', 'Password not matched');
            } else{
                $request->session()->put('loginid', $chkemail->userId);
                $request->session()->put('loginfirstname', $chkemail->firstname);
                $request->session()->put('loginlastname', $chkemail->lastname);
                $request->session()->put('loginemail', $chkemail->email);
                $request->session()->put('loginrole', $chkemail->role);
                return redirect('admin/dashboard');
            }
        }
    }

    function logout(){
        if(Session::has('loginid')){
            Session::pull('loginid');
            return redirect('admin/login');
        }
    }

    function editUser($userid){
        if(Session::has('loginid') == false){
            return redirect('admin/login');
        } elseif(Session::get('loginrole') != '2'){
            return redirect('admin/dashboard');
        } else{
            $user = UserModel::where('userId','=',$userid)->get();
            return view('admin.edituser', compact('user'));
        }
    }

    function updateUser(Request $request, $userid){
        $user = UserModel::where('userId','=',$userid)->get();

        $request->validate([
            'userrole' => 'required'
        ]);

        foreach($user as $value){
            $userrole = $request->input('userrole');
            $result = DB::table('users')->where('userId','=',$userid)->update(['role'=>$userrole]);
        }

        if($result){
            return redirect('admin/users')->with('success', 'User role updated');
        } else{
            return back()->with('fail', 'Something went wrong!');
        }
    }

    function removeUser($userid){
        $user = UserModel::where('userId','=',$userid)->get();

        foreach($user as $value){
            $result = DB::table('users')->where('userId','=',$userid)->delete();
            $delpost = DB::table('tbl_post')->where('postedby','=',$userid)->delete();
        }

        if($result){
            return back()->with('success', 'User removed');
        } else{
            return back()->with('fail', 'Something went wrong!');
        }
    }

    function updateProfile($userid, Request $request){
        $user = UserModel::where('userId','=',$userid)->get();

        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'userimage'=>'image|max:2048|mimes:jpg,png,jpeg'
        ]);

        foreach($user as $value){
            $firstname = $request->input('firstname');
            $lastname = $request->input('lastname');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $about = $request->input('about');

            if($request->hasfile('userimage')){
                $userimg = $request->file('userimage');
                $extension = $userimg->getClientOriginalExtension();
                $newname = time().'.'.$extension;
                $userimg->move('uploads/users/', $newname);

                DB::table('users')->where('userId','=',$userid)->update(['userImg'=>$newname]);
            }

            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->email = $email;
            $user->phone = $phone;
            $user->about = $about;

            $result = DB::table('users')->where('userId','=',$userid)->update(['firstname'=>$firstname, 'lastname'=>$lastname, 'email'=>$email, 'phone'=>$phone, 'about'=>$about]);
        }
        if($result){
            return back()->with('success', 'Profile updated');
        } else{
            return back()->with('fail', 'Something went wrong!');
        }
    }

}


