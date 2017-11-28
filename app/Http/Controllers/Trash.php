<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photos;
use Auth;
use App\Categories;

class Trash extends Controller
{
    public function index(){
        $data['auth']       = Auth::user();
        $data['halaman']    = '';

        $data['categories'] = Categories::orderBy('name')->get();
        $data['photos']     = Photos::onlyTrashed()->where('user_id', Auth::user()->id)->get();

        return View('trash', $data);
    }

    public function restore(Request $request){
        $id         = $request->id;
        
        $photos     = Photos::withTrashed()->findOrFail($id)->where('user_id', Auth::user()->id);

        Photos::withTrashed()->find($id)->restore();

        $output[0]  = "Selamat!";
        $output[1]  = "Photo berhasil di restore";
        $output[2]  = "success";
        exit(json_encode($output));
    }

    public function delete(Request $request){
        $id         = $request->id;
        
        $photos     = Photos::withTrashed()->findOrFail($id)->where('user_id', Auth::user()->id);

        Photos::withTrashed()->find($id)->forceDelete();

        $output[0]  = "Selamat!";
        $output[1]  = "Photo berhasil di hapus";
        $output[2]  = "success";
        exit(json_encode($output));
    }
}
