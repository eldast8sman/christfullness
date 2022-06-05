<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class FileController extends Controller
{
    public static function uploadfile($filepath, $destination){
        if($filepath instanceof UploadedFile){
            $time = time();
            $filename = Str::random().$time;
            $extension = $filepath->getClientOriginalExtension();
            $name = $filename.'.'.$extension;
            if(($extension == 'jpg') || ($extension == 'jpeg') || ($extension == 'gif') || ($extension == 'png')){
                $filepath->move(public_path('img/'.$destination.'/'), $name);
                $Image = Image::make('img/'.$name);
                $Image->resize(50, null, function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('img/'.$destination.'/compressed/'.$name));
                return $name;
            } elseif(($extension == 'mp3') || ($extension == 'mpeg3')){
                $filepath->move(public_path('audio'), $name);
                return $name;
            } else {
                return false;
            }
        }
    }

    public static function check_file($filepath){
        if(File::exists($filepath)){
            return true;
        } else {
            return false;
        }
    }

    public static function delete_file($filepath){
        if(File::delete($filepath)){
            return true;
        } else {
            return false;
        }
    }
}
