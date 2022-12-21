<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\project;

class ctrl extends Controller
{
    function index(){
        return view('home');
    }

    function redirectFunct(){
        $typeuser=Auth::user()->usertype;
        $username=Auth::user()->name;
        
        if($typeuser=='1')
        {
            return view('admin',['name'=>$username]);
        }
        else
        {
            return view('user',['name'=>$username]);
        }
    }

    function add(){
        $data=Auth::user();
        return view('add', ['name'=>$data]);
    }

    function register(Request $x){
        $project=new project;
        $project->projtitle = $x->title;
        $project->student = $x->student;
        $project->supervisor = $x->sv;
        $project->examiner1 = $x->ex1;
        $project->examiner2 = $x->ex2;
        $project->save();
        return redirect('/view');
    }

    function view(){
        $data=project::paginate(10);
        return view('view',['data'=>$data]);
    }

    function delete($id)
    {
        $data=project::find($id);
        $data->delete();
        //DB::delete('delete from students where stud_id=?', [$id]);
        return redirect('/view');
    }

    function update($id)
    {
        $data=project::find($id);
        return view('update', ['display'=>$data]);
    }

    function updateForm(Request $req)
    {
        $data=project::find($req->id);
        $data->projtitle = $req->title;
        $data->student = $req->student;
        $data->supervisor = $req->sv;
        $data->examiner1 = $req->ex1;
        $data->examiner2 = $req->ex2;
        $data->save();
        return redirect('/view');
    }

    function viewProj(){
        $data=project::paginate(10);
        $username=Auth::user()->name;
        return view('viewProj',['data'=>$data, 'name'=>$username]);
    }

    function updProj($id)
    {
        $data=project::find($id);
        return view('updProj', ['display'=>$data]);
    }

    function updForm(Request $req)
    {
        $data=project::find($req->id);
        $data->start = $req->start;
        $data->end = $req->end;
        $data->duration = $req->duration;
        $data->progress = $req->progress;
        $data->status = $req->status;
        $data->save();
        return redirect('/viewProj');
    }
}
