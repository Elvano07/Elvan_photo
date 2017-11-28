<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Categories;
use App\Photos;
use Illuminate\Support\Facades\Storage;
use Response;
use DB;
use Image;
use Input;
use Carbon\Carbon;

class Home extends Controller
{
    public function index(){
        //-- Mengambil variable Auth dari Class Auth PHP
        $data['auth']       = Auth::user();

        //-- Nama halaman yang nantinya akan dipakai pada menu navigation pada view layout.blade.php
        $data['halaman']    = 'home';

        //-- Mengambil semua kategori
        $data['categories'] = Categories::orderBy('name')->get();


        $photo = Photos::where('title', '!=', 'NULL')->orderBy('created_at', 'DESC')->get();

        return View('home', $data, compact('photo'));
    

   // public function index(){
    //     //-- Mengambil variable Auth dari Class Auth PHP
    //     $data['auth']       = Auth::user();

    //     //-- Nama halaman yang nantinya akan dipakai pada menu navigation pada view layout.blade.php
    //     $data['halaman']    = 'home';

    //     //-- Mengambil semua kategori
    //     $data['categories'] = Categories::orderBy('name')->get();

    //     //-- Mengambil foto dari semua user
    //     $data['photos']     = Photos::with('categories')->orderBy('created_at', 'desc')->get();
    
         //-- Membuat array tahun dan counter i
         $tahun  = [];
         $i      = 0;

         //-- Mengumpul semua tahun yang ada pada $data['photos']
         foreach($data['photos'] as $key => $value){
             $tahun[$i]  = Carbon::parse($value->created_at)->year;
             $i++;
         }

         //-- Mengubah array menjadi unique
         $tahun  = array_unique($tahun);
        
         //-- Reindexing array
         $tahun  = array_values($tahun);

         //-- Mengurutkan array $tahun
         // sort($tahun);

         $i      = 0;

         //-- Membuat array tahun bulan untuk menampung tahun dan bulan
         $arrayTahunBulan    = [];
        
         foreach($tahun as $key1 => $value1){
             $arrayTahunBulan[$value1]   = [];

             foreach($data['photos'] as $key2 => $value2){

                 //-- Jika tahunya sama maka bulan akan ditampung kedalam array
                 if($value1 == Carbon::parse($value2->created_at)->year){
                     $arrayTahunBulan[$value1][$i]   = Carbon::parse($value2->created_at)->month;
                 }
                 $i++;
             }

             $i  = 0;
             //-- Mengubah array menjadi unique
             $arrayTahunBulan[$value1]  = array_unique($arrayTahunBulan[$value1]);
        
             //-- Reindexing array
             $arrayTahunBulan[$value1]  = array_values($arrayTahunBulan[$value1]);
    
             //-- Mengurutkan array $arrayTahunBulan[$value1]
             // sort($arrayTahunBulan[$value1]);
         }
        
         $groupPhotos    = [];
         $bulan          = [];
         foreach($tahun as $key1 => $value1){
             $i  = 0;
            
             foreach($arrayTahunBulan[$value1] as $key2 => $value2){
                 $j  = 0;
                
                 foreach($data['photos'] as $key3 => $value3){
                    
                     if($value2 == Carbon::parse($value3->created_at)->month && $value1 == Carbon::parse($value3->created_at)->year){
                         $groupPhotos[$value1][$value2][$j]   = $data['photos'][$key3];
                         $j++;
                         unset($data['photos'][$key3]);
                     }
    
                 }

                 $bulan[$value1][$value2]['bulan']   = Carbon::create(0, $value2 + 1, 0, 0, 0, 0, 0)->format('F');
                 $bulan[$value1]['tahun']            = $value1;
             }

         }

         //-- Redeklarasi variable foto
         $data['photos']     = $groupPhotos;
         $data['bulan']      = $bulan;

         //-- Mengambil view
         return View('home', $data);
     }

    public function showphoto($id){
        //-- Mengambil data foto beserta kategorinya
        $data['photos']     = Photos::where('id', $id)->with('categories')->first();

        //-- Jika foto tidak ditemukan maka akan mengiriman error 404
        if($data['photos'] == null){
            abort(404);
        }
        
        $data['halaman']    = '';
        $data['categories'] = Categories::orderBy('name')->get();
        $data['auth']       = Auth::user();

        //-- Mengambil path atau tempat foto disimpan
        $path           = storage_path() . "/app/" . $data['photos']->filelocation;

        //-- Mengambil exif dari gambar
        $image          = Image::make($path)->exif();
        $data['exif']   = $image;
        
        //-- Mengambil view
        return View('download', $data);
    }

    public function downloadphoto(Request $request){
        //-- Mengambil foto berdasarkan ID
        $photos = Photos::find($request->id);
        
        //-- Menambah jumlah download
        $photos->download += 1;

        //-- Save foto
        $photos->save();
        
        //-- Mengambil file foto
        $filepath = storage_path()."/app/".$photos->filelocation;

        //-- Download foto
        return Response::download($filepath);
    }

    public function deletephoto($id){
        //-- Cari foto berdasarkan ID
        $photos     = Photos::findOrFail($id);

        //-- Jika user bukan pemilik foto maka akan menghentikan proses dengan mengirim error 404
        if(Auth::user()->id != $photos->user_id){
            abort(404);
        }

        //-- hapus foto
        $photos->delete();

        //-- redirect ke halaman home
        return redirect('home')->with('status', 'Foto anda berhasil dihapus.');
    }

    // public function showcategories($category){
    //     $categories = Categories::where('name', $category)->first();
    //     $photo = Photos::where('categories_id', $categories->id)->get();

    //     //-- Membuat array tahun dan counter i
    //     $tahun  = [];
    //     $i      = 0;

    //     //-- Mengumpul semua tahun yang ada pada $data['photos']
    //     foreach($photo as $foto){
    //         $tahun[$i]  = Carbon::parse($foto->created_at)->year;
    //         $i++;
    //     }
    //     //-- Mengubah array menjadi unique
    //     $tahun  = array_unique($tahun);
        
    //     //-- Reindexing array
    //     $tahun  = array_values($tahun);

    //     //-- Mengurutkan array $tahun
    //     // sort($tahun);

    //     $i      = 0;

    //     //-- Membuat array tahun bulan untuk menampung tahun dan bulan
    //     $arrayTahunBulan    = [];
        
    //     foreach($tahun as $key1 => $value1){
    //         $arrayTahunBulan[$value1]   = [];

    //         foreach($photo as $key2 => $value2){

    //             //-- Jika tahunya sama maka bulan akan ditampung kedalam array
    //             if($value1 == Carbon::parse($value2->created_at)->year){
    //                 $arrayTahunBulan[$value1][$i]   = Carbon::parse($value2->created_at)->month;
    //             }
    //             $i++;
    //         }

    //         $i  = 0;
    //         //-- Mengubah array menjadi unique
    //         $arrayTahunBulan[$value1]  = array_unique($arrayTahunBulan[$value1]);
        
    //         //-- Reindexing array
    //         $arrayTahunBulan[$value1]  = array_values($arrayTahunBulan[$value1]);
    
    //         //-- Mengurutkan array $arrayTahunBulan[$value1]
    //         // sort($arrayTahunBulan[$value1]);
    //     }
        
    //     $groupPhotos    = [];
    //     $bulan          = [];
    //     foreach($tahun as $key1 => $value1){
    //         $i  = 0;
            
    //         foreach($arrayTahunBulan[$value1] as $key2 => $value2){
    //             $j  = 0;
                
    //             foreach($photo as $key3 => $value3){
                    
    //                 if($value2 == Carbon::parse($value3->created_at)->month && $value1 == Carbon::parse($value3->created_at)->year){
    //                     $groupPhotos[$value1][$value2][$j]   = $photo[$key3];
    //                     $j++;
    //                     unset($photo[$key3]);
    //                 }
    
    //             }

    //             $bulan[$value1][$value2]['bulan']   = Carbon::create(0, $value2 + 1, 0, 0, 0, 0, 0)->format('F');
    //             $bulan[$value1]['tahun']            = $value1;
    //         }

    //     }
    //     // dd($arrayTahunBulan);

    //     $data['auth']       = Auth::user();
    //     $data['halaman']    = '';

    //     //-- Mengambil semua data kategory
    //     $data['categories'] = Categories::orderBy('name')->get();
    //     $categories         = Categories::where('name', $category)->first();

    //     return View('categories', compact('photo', 'category'), $data);
    // }
 // public function showcategories($category){
 //        $data['auth']       = Auth::user();
 //        $data['halaman']    = '';

 //        //-- Mengambil semua data kategory
 //        $data['categories'] = Categories::orderBy('name')->get();
 //        $categories         = new Categories;

 //        //-- Mengambil semua foto berdasarkan kategory
 //        $data['photos']     = $categories->where('name', $category)->with('photos')->get();

 //        //-- Title category
 //        $data['title']      = $category;
    
 //        //-- Jika data foto tidak ada maka akan dihentikan dengan mengirim error 404
 //        if($data['photos']->isEmpty()){
 //            abort(404);
 //        }

 //        //-- Mengambil view
 //        return View('categories', $data);
 //    }
    public function showcategories($category){
        $data['auth']       = Auth::user();
        $data['halaman']    = '';

        //-- Mengambil semua data kategory
        $data['categories'] = Categories::orderBy('name')->get();
        $categories         = Categories::where('name', $category)->first();

        //-- Jika data foto tidak ada maka akan dihentikan dengan mengirim error 404
        if($categories == null){
            abort(404);
        }

        //-- Mengambil semua foto berdasarkan kategory
        $data['photos']     = $categories->where('name', $category)->with('photos')->get();

        //-- Title category
        $data['title']      = $category;

        //-- Membuat array tahun dan counter i
        $tahun  = [];
        $i      = 0;

        // //-- Mengumpul semua tahun yang ada pada $data['photos']
        foreach($data['photos'] as $key => $value){
            $tahun[$i]  = Carbon::parse($value->created_at)->year;
            $i++;
        }

        //-- Mengubah array menjadi unique
        $tahun  = array_unique($tahun);
        
        //-- Reindexing array
        $tahun  = array_values($tahun);

        //-- Mengurutkan array $tahun
        // sort($tahun);

        $i      = 0;

        //-- Membuat array tahun bulan untuk menampung tahun dan bulan
        $arrayTahunBulan    = [];
        
        foreach($tahun as $key1 => $value1){
            $arrayTahunBulan[$value1]   = [];

            foreach($data['photos'] as $key2 => $value2){

                //-- Jika tahunya sama maka bulan akan ditampung kedalam array
                if($value1 == Carbon::parse($value2->created_at)->year){
                    $arrayTahunBulan[$value1][$i]   = Carbon::parse($value2->created_at)->month;
                }
                $i++;
            }

            $i  = 0;
            //-- Mengubah array menjadi unique
            $arrayTahunBulan[$value1]  = array_unique($arrayTahunBulan[$value1]);
        
            //-- Reindexing array
            $arrayTahunBulan[$value1]  = array_values($arrayTahunBulan[$value1]);
    
            //-- Mengurutkan array $arrayTahunBulan[$value1]
            // sort($arrayTahunBulan[$value1]);
        }
        
        $groupPhotos    = [];
        $bulan          = [];
        foreach($tahun as $key1 => $value1){
            $i  = 0;
            
            foreach($arrayTahunBulan[$value1] as $key2 => $value2){
                $j  = 0;
                
                foreach($data['photos'] as $key3 => $value3){
                    
                    if($value2 == Carbon::parse($value3->created_at)->month && $value1 == Carbon::parse($value3->created_at)->year){
                        $groupPhotos[$value1][$value2][$j]   = $data['photos'][$key3];
                        $j++;
                        // unset($data['photos'][$key3]);
                    }
    
                }

                $bulan[$value1][$value2]['bulan']   = Carbon::create(0, $value2 + 1, 0, 0, 0, 0, 0)->format('F');
                $bulan[$value1]['tahun']            = $value1;
            }

        }

        // //-- Redeklarasi variable foto
        // $data['photos']     = $groupPhotos;
        $data['bulan']      = $bulan;

        //-- Mengambil view
        return View('categories', $data);
    }

    public function search(Request $request){
        //-- Jika keyword search adalah null maka akan dikembalikan kehalaman home
        if($request->keywords==null){
            return redirect()->route('home');
        }

        //-- Mengubah keyword menjadi huruf kecil
        $keywords   = strtolower($request->keywords);

        //-- Query untuk mencari keyword user
        $search     = DB::select("  select a.id, title, location, tag, description, filelocation, created_at, name from photos a
                                    left join categories b
                                    on a.categories_id = b.id
                                    where lower(title) like '%$keywords%' or
                                    lower(location) like '%$keywords%' or
                                    lower(tag) like '%$keywords%' or
                                    lower(description) like '%$keywords%' or
                                    lower(name) like '%$keywords%'");

        //-- Mengambil semua kategori
        $data['categories'] = Categories::orderBy('name')->get();

        //-- Mengambil keyword user
        $data['keywords']   = $request->keywords;

        //-- Mengambil semua foto berdasarkan keywords
        $data['search']     = $search;

        //-- Nama halaman yang nantinya akan dipakai pada menu navigation pada view layout.blade.php
        $data['halaman']    = "";

        //-- Mengambil variable Auth dari Class Auth PHP
        $data['auth']       = Auth::user();

        //-- Mengambil view
        return View('search', $data);
    }

    public function adddesc(Request $request){
        //-- Mengambil semua kategori
        $data['categories'] = Categories::orderBy('name')->get();

        //-- Mengambil keyword user
        $data['keywords']   = $request->keywords;

        //-- Nama halaman yang nantinya akan dipakai pada menu navigation pada view layout.blade.php
        $data['halaman']    = "";

        //-- Mengambil variable Auth dari Class Auth PHP
        $data['auth']       = Auth::user();

        $photo = Photos::where('title', '=', NULL)->get();

        //-- Mengambil view
        return View('adddesc', $data, compact('photo'));
    }

    public function savephoto(Request $request){
        //-- Mengambil semua kategori
        $data['categories'] = Categories::orderBy('name')->get();

        //-- Mengambil keyword user
        $data['keywords']   = $request->keywords;

        //-- Nama halaman yang nantinya akan dipakai pada menu navigation pada view layout.blade.php
        $data['halaman']    = "";

        //-- Mengambil variable Auth dari Class Auth PHP
        $data['auth']       = Auth::user();

        // $photo = Photos::where('title', '=', NULL)->get();        
        // // dd($photo);
        // foreach($photo as $photos){
        //     $foto = new Photos();
        //     $foto->title = "nyoba";
        //     $foto->save();
        // }

        // $photo = Photos::where('title', '=', NULL)->get();
        $photos = $request->photos;
        $index = 0;
        foreach($photos as $photos){
            $title = Input::get('title')[$index];
            $location = Input::get('location')[$index];
            $category = Input::get('category')[$index];
            $tag = Input::get('tag')[$index];
            $description = Input::get('description')[$index];

            if($title != "" && $location != "" && $category != 0 && $tag != "" && $description != ""){
                $img = Photos::where('id', '=', $photos)->first();
                $img->categories_id = $category;
                $img->title = $title;
                $img->location = $location;
                $img->tag = $tag;
                $img->description = $description;
                $img->download = 0;
                $img->save();
            }

            $index++;

            // $img = Photos::where('id', '=', $photos)->update([
            //         'title' => $title,
            //     ]);
        }

        //-- Mengambil view
        return redirect()->action('Home@index'); 
    }
}
