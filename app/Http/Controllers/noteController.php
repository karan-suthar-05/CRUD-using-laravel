<?php

namespace App\Http\Controllers;

use App\Models\note;
use Illuminate\Http\Request;

class noteController extends Controller
{
    public function addNote(Request $req)
    {
        $req->validate([
            'title'=>'required',
            'desc'=>'required'
        ]);
        $note = new note;
        $note->title = $req["title"];
        $note->description = $req["desc"];
        $note->uid = session()->get("uid");
        $note->save();
        return redirect()->back();
    }

    public function editNote(Request $req)
    {
        $req->validate([
            'etitle'=>'required',
            'edesc'=>'required'
        ]);
        $id = $req->eid;
        $note = note::find($id);
        $note->title = $req->etitle;
        $note->description = $req->edesc;
        $note->save();
        return redirect()->back();
    }

    public function deleteNote($id)
    {
        $note = note::find($id);
        if($note)
        {
            $note->delete();
            return redirect()->back();
        }
        else
        {
            return view("404");
        }
    }
}
