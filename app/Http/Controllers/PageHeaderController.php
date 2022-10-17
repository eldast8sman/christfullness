<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageHeaderRequest;
use App\Http\Requests\UpdatePageHeaderRequest;
use App\Models\PageHeader;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class PageHeaderController extends Controller
{
    public function index(){
        $headers = PageHeader::orderBy('page', 'asc');
        if($headers->count() > 0){
            $headers = $headers->get();
            foreach($headers as $header){
                $header->filename = url($header->filename);
                $header->compressed = url($header->compressed);
            }
            return response([
                'status' => 'success',
                'message' => 'Page Headers fetched successfully',
                'data' => $headers
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Header was fetched'
            ], 404);
        }
    }

    public function store(StorePageHeaderRequest $request){
        $all = $request->all();
        $image = $all['filename'];
        unset($all['filename']);
        $upload = FileController::uploadfile($image, 'headers');
        if($upload){
            $all['filename'] = 'img/headers/'.$upload;
            $all['compressed'] = 'img/headers/compressed/'.$upload;
        }
        $header = PageHeader::create($all);
        if($header){
            return response([
                'status' => 'success',
                'message' => 'Page Header uploaded successfully',
                'data' => $header
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Header Upload failed'
            ], 500);
        }
    }

    public function show($id){
        $header = PageHeader::find($id);
        if(!empty($header)){
            $header->filename = url($header->filename);
            $header->compressed = url($header->compressed);
            return response([
                'status' => 'success',
                'message' => 'Page Header fetched successfully',
                'data' => $header
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Page Header was not fetched'
            ], 404);
        }
    }

    public function update(UpdatePageHeaderRequest $request, $id){
        $header = PageHeader::find($id);
        if(!empty($header)){
            $all = $request->all();
            if(!empty($all['filename'])){
                $image = $all['filename'];
                if($image instanceof UploadedFile){
                    FileController::delete_file($header->filename);
                    FileController::delete_file($header->compressed);

                    $upload = FileController::uploadfile($image, 'headers');
                    if($upload){
                        $all['filename'] = 'img/headers/'.$upload;
                        $all['compressed'] = 'img/photos/compressed'.$upload;
                    }
                }
            } else {
                unset($all['filename']);
            }
            if($header->update($all)){
                $header->filename = url($header->filename);
                $header->compressed = url($header->compressed);
                return response([
                    'status' => 'success',
                    'message' => 'Page Header Updated successfully',
                    'data' => $header
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Error in Header Update'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Page Header was fetched'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $photo = PageHeader::find($id);
        if($photo->delete()){
            FileController::delete_file($photo->filename);
            FileController::delete_file($photo->compressed);
            return response([
                'status' => 'success',
                'message' => 'Page Header deleted successfully',
                'data' => $photo
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Page Header Delete failed'
            ], 500);
        }
    }
}
