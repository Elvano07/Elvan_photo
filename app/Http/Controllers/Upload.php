<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Input;
use App\Categories;
use App\Photos;
use Illuminate\Http\UploadedFile;

class Upload extends Controller
{
    
    public function index(){
        $data['auth']       = Auth::user();
        $data['halaman']    = 'upload';
        
        $data['categories'] = Categories::orderBy('name')->get();

        return View('upload', $data);
    }

    public function uploadPost(Request $request){
        $ds          = DIRECTORY_SEPARATOR;
        $filename = $_FILES['file']['name'];
         
        $storeFolder = '../../../storage/app/photo/';
        $tempFile = $_FILES['file']['tmp_name']; 
        $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
        $targetFile =  $targetPath. $filename;
        move_uploaded_file($tempFile,$targetFile);

        $photos     = new Photos();
        $photos->user_id        = Auth::user()->id;
        $photos->filename       = $filename;
        $photos->filelocation   = "photo/".$filename;
        $photos->save();

        return redirect('adddesc');

    }

     public function testupload(){
        $photos     = new Photos();
        $photos->user_id        = Auth::user()->id;
        $photos->filename       = "asdf";
        $photos->filelocation   = "asdf";
        $photos->save();

     }

//     public function uploadPost(Request $request){
//         $messages   =   [
//             'required'  => 'The :attribute field is required.',
//             'max'       => 'Maximum :attribute length is :max.',
//             'image'     => 'The photo must be and image.'
//         ];
        
//         $rules      =   [
//             'title'         => 'required|max:255',
//             'location'      => 'required|max:255',
//             'category'      => 'required|max:255',
//             'tag'           => 'max:255',
//             'description'   => 'required|max:255',
//             'photo'         => 'required',
//             'image'         => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
//         ];

//         $data       =   [
//             'title'         => $request->title,
//             'location'      => $request->location,
//             'category'      => $request->category,
//             'tag'           => $request->tag,
//             'description'   => $request->description,
//             'photo'         => $request->photo,
//             'image'         => $request->file('photo')
//         ];

//         $validator  = Validator::make($data, $rules, $messages);
        
//         if ($validator->fails())
//         {
//             return back()->withErrors($validator, 'upload')->withInput();
//         }

//         $photos     = new Photos();

//         $photos->title          = $request->title;
//         $photos->location       = $request->location;
//         $photos->categories_id  = $request->category;
//         $photos->tag            = $request->tag;
//         $photos->description    = $request->description;
//         $photos->filename       = $request->file('photo')->getClientOriginalName();;
//         $photos->user_id        = Auth::user()->id;
//         $photos->filelocation   = $request->file('photo')->store('photo');

//         $photos->save();

//         return redirect('adddesc.php')->with('status', 'Photo berhasil disimpan!');
//         // upload 
//         return redirect('Upload.php')->with('status', 'Photo berhasil disimpan!');

// //ketika klik tombol add description, foto yg ditaro diatas itu masuk ke db semua, dia masukin foto sama nama file fotonya aja, description title dll kosongin, lalu return ke page adddesc, nah di page desc itu ntar narik data dari DB yg title,desc,dll nya masih kosong, nah object data itu di looping buat section isi title, desc ,dll nya itu

//     }

}
