<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;

class AboutController extends Controller
{
    public function index(){
        $abouts = About::orderBy('position', 'asc')->orderBy('updated_at', 'desc');
        if($abouts->count() > 0){
            return response([
                'status' => 'success',
                'message' => 'About Us section fetched successfully',
                'data' => $abouts->get()
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No About Section was fetched'
            ], 404);
        }
    }

    public function store(StoreAboutRequest $request){
        $file = $request->file('file');
        $all = $request->except(['file']);
        if($upload_image = FileController::uploadfile($file, 'about_us')){
            $all['filename'] = 'img/about_us/'.$upload_image;
            $all['compressed'] = 'img/about_us/compressed/'.$upload_image;

            if($about = About::create($all)){
                $about->filename = url($about->filename);
                $about->compressed = url($about->compressed);

                return response([
                    'status' => 'success',
                    'message' => 'About us uploaded successfully',
                    'data' => $about
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'About Us Upload Failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Picture upload failed'
            ], 500);
        }
    }

    public function show($id){
        if(!empty($about = About::find($id))){
            $about->filename = url($about->filename);
            $about->compressed = url($about->compressed);

            return response([
                'status' => 'success',
                'message' => 'About Us fetched successfully',
                'data' => $about
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No About Us Section was fetched'
            ], 404);
        }
    }

    public function update(UpdateAboutRequest $request, $id){
        if(!empty($about = About::find($id))){
            $all = $request->except(['file']);
            if(!empty($file = $request->file('file'))){
                if($file instanceof UploadedFile){
                    if($upload = FileController::uploadfile($file, 'about_us')){
                        $all['filename'] = 'img/about_us/'.$upload;
                        $all['compressed'] = 'img/about_us/compressed/'.$upload;

                        FileController::delete_file($about->filename);
                        FileController::delete_file($about->compressed);
                    }
                }
            }
            if($about->update($all)){
                $about->filename = url($about->filename);
                $about->compressed = url($about->compressed);

                return response([
                    'status' => 'success',
                    'message' => 'About Us Updated successfully',
                    'data' => $about
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'About Us Update Failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No About Us Section was fetched'
            ], 404);
        }
    }

    public function destroy($id){
        if(!empty($about = About::find($id))){
            if($about->delete()){
                FileController::delete_file($about->filename);
                FileController::delete_file($about->compressed);

                return response([
                    'status' => 'success',
                    'message' => 'About Us successfully deleted',
                    'data' => $about
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'About Us Deletion failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No About Us was Fetched'
            ], 404);
        }
    }

    public function destroy_photo($id){
        if(!empty($about = About::find($id))){
            FileController::delete_file($about->filename);
            FileController::delete_file($about->compressed);

            return response([
                'status' => 'success',
                'message' => 'About Us successfully deleted',
                'data' => $about
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No About Us was Fetched'
            ], 404);
        }
    }
}
