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
}
