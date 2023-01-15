<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateWelcomeMessageRequest;
use App\Models\WelcomeMessage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class WelcomeMessageController extends Controller
{
    public function add_message(UpdateWelcomeMessageRequest $request){
        $welcome = WelcomeMessage::first();
        if(!empty($welcome)){
            $all = $request->all();
            if(!empty($all['filename'])){
                $image_path = $all['filename'];
                unset($all['filename']);
                if($image_path instanceof UploadedFile){
                    FileController::delete_file($welcome->filename);
                    FileController::delete_file($welcome->compressed);

                    $upload = FileController::uploadfile($image_path, 'welcome_message');
                    if($upload){
                        $all['filename'] = 'img/welcome_message/'.$upload;
                        $all['compressed'] = 'img/welcome_message/'.$upload;
                    }
                }
            } else {
                unset($all['filename']);
            }
            if($welcome->update($all)){
                return response([
                    'status' => 'success',
                    'message' => 'Welcome Message Updated successfully',
                    'data' => $welcome
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Welcome Message Update Failed'
                ], 500);
            }
        } else {
            $all = $request->all();
            if(!empty($all['filename'])){
                $image_path = $all['filename'];
                unset($all['filename']);
                if($upload_image = FileController::uploadfile($image_path, 'welcome_message')){
                    $all['filename'] = 'img/welcome_message/'.$upload_image;
                    $all['compressed'] = 'img/welcome_message/compressed/'.$upload_image;

                    $welcome = WelcomeMessage::create($all);
                    if($welcome){
                        $welcome->filename = url($welcome->filename);
                        $welcome->compressed = url($welcome->compressed);
                        return response([
                            'status' => 'success',
                            'message' => 'Welcome Message Updated successfully',
                            'data' => $welcome
                        ], 200);
                    } else {
                        return response([
                            'status' => 'failed',
                            'message' => 'Welcome Message was not Updated'
                        ], 500);
                    }
                } else {
                    return response([
                        'status' => 'failed',
                        'message' => 'Could not Upload Image'
                    ], 500);
                }
            }
        }
    }
}
