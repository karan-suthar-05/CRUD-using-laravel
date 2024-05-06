<?php

namespace App\Http\Controllers;

use App\Models\note;
use Illuminate\Http\Request;

class renderPage extends Controller
{
    public function home()
    {
        return view("home");
    }
    public function index(Request $req)
    {   
        $search = $req->query('se', 'default_value');

    
        if ($search !== 'default_value') {
            $note = note::where('uid', session()->get("uid"))->where('title', 'like', "%$search%")->orWhere('description', 'like', "%$search%")->get();
        } else {
           
            $note = note::where('uid', session()->get("uid"))->get();
        }

        
        if(!$note->isEmpty())
        {
            $data = compact('note');
        }
        else
        {
            $msg = "Please enter any note...";
            $data = compact('msg');
        }
        
        
        return view("index")->with($data);
    }

    public function registrationPage()
    {
        return view("registration");
    }
    public function loginPage()
    {
        return view("login");
    }
}
