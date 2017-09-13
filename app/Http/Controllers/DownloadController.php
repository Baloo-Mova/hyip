<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
     public function file($name){
         if(isset($name) && file_exists(storage_path('app/files/'.$name))){
             return response()->file(storage_path('app/files/'.$name));
         }

         abort(404);
     }

     public function getImage($type, $name)
     {
         if(isset($name) && Storage::disk('uploads')->exists('/'.$type.'/'.$name)){
             return response()->file(storage_path('media/uploads/'.$type.'/'.$name));
         }

         abort(404);
     }
}
