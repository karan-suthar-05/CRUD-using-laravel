<?php

namespace App\Http\Controllers;

use App\Models\noteuser;
use Illuminate\Http\Request;

class authentication extends Controller
{
    public function register(Request $req)
    {
        $req->validate([
            'uname'=>'required',
            'pass'=>'required',
            'cpass'=>'required|same:pass'
        ]);

        $uname = $req->uname;
        $noteuser = noteuser::where('username',$uname)->first();
        if($noteuser)
        {
            return redirect()->back()->withInput()->withErrors(['uname' => 'Username already exists.']);   
        }
        else
        {
            $noteuser = new noteuser;
            $noteuser->username = $req->uname;
            $noteuser->password = $req->pass;
            $noteuser->save();

            return redirect()->route("home")->with("success","registration successfull");
        }
    }

    public function login(Request $req)
    {
        $req->validate([
            'uname'=>'required',
            'pass'=>'required',
        ]);
        $uname = $req->uname;
        $upass = $req->pass;
        $noteuser = noteuser::where('username',$uname)->first();
        if($noteuser)
        {
            if($upass == $noteuser->password)
            {
                session(["uid"=>$noteuser->uid,"uname"=>$uname,"islogin"=>true]);
                return redirect()->route("note");
            }
            else
            {
                return redirect()->back()->withInput()->withErrors(['pass' => 'Incorrect password.']);   
            }
        }
        else
        {
            return redirect()->back()->withInput()->withErrors(['uname' => 'Username not found.']);   
        }

    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
