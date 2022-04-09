<?php

namespace App\Http\Controllers\Google;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GoogleDriveController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'file'=>'required|mimes:jpg,bmp,png,doc,docx,txt'
        ]);


        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        Storage::disk('google')->putFileAs('',$file,$file_name);
        return back();
    }

    public function putInDirectory(Request $request){

        $request->validate([
            'dir_name'=>'required',
            'dir_file'=>'required',
        ]);

        $dir_name = $request->dir_name;
        $file = $request->file('dir_file');
        $file_name = $file->getClientOriginalName();

        $content = collect(Storage::disk('google')->listContents('/', false));

        $root = false;
        foreach ($content as $key => $value) {
            if($value['name'] == $dir_name)
                $root = $value['path'];
        }

        if($root){
            $dir = '/'.$root;
            Storage::disk('google')->putFileAs($dir,$file,$file_name);
        }

        return back();
    }


    public function createDirectory(Request $request){
        $request->validate([
           'directory_name'=>'required'
        ]);

        Storage::disk('google')->makeDirectory($request->directory_name);
        return back();

    }

    public function removeDirectory(Request $request){
        $request->validate([
           'id'=>'required'
        ]);

        Storage::disk('google')->deleteDirectory($request->id);
        return 1;

    }

    public function fileURL(Request $request){
        $request->validate([
           'file'=>'required'
        ]);

        $url =  Storage::disk('google')->url($request->file);

        return $url;

    }

    public function removeFile(Request $request){
        $request->validate([
           'file'=>'required'
        ]);

        $s=Storage::disk('google')->delete($request->file);

        if($s)
            return 1;

        return false;
    }
}
