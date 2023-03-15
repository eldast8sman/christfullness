<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Message;
use App\Models\Minister;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::orderBy('date_preached', 'desc')->orderBy('created_at', 'desc');
        if($messages->count() > 0){
            $msgs = $messages->get();
            foreach($msgs as $msg){
                $msg->image_path = url($msg->image_path);
                $msg->compressed_image = url($msg->compressed_image);
                $msg->audio_path = url($msg->audio_path);
            }
            return response([
                'status' => 'success',
                'message' => 'Messages found',
                'data' => $msgs
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Messages not found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        $all = $request->all();
        $image = $all['image_path'];
        unset($all['image_path']);
        $audio = $all['audio_path'];
        unset($all['audio_path']);
        $upload_image = FileController::uploadfile($image, 'messages');
        if($upload_image){
            $all['image_path'] = 'img/messages/'.$upload_image;
            $all['compressed_image'] = 'img/messages/compressed/'.$upload_image;
        }
        $upload_audio = FileController::uploadfile($audio, 'messages');
        if($upload_audio){
            $all['audio_path'] = 'audio/messages/'.$upload_audio;
        }
        $series = Series::where('id', $all['series_id'])->first();
        $minister = Minister::where('id', $all['minister_id'])->first();
        $all['details'] = $all['title'].' '.$all['description'].' '.$series->title.' '.$minister->name.' '.date('l, jS \of F, Y');
        $message = Message::create($all);
        if($message){
            $series = $message->series()->get();
            $minister = $message->minister()->get();
            $message->image_path = url($message->image_path);
            $message->compressed_image = url($message->compressed_image);
            $message->audio_path = url($message->audio_path);
            return response([
                'status' => 'success',
                'message' => 'Message Uploaded successfully',
                'data' => $message
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'There was an error uploading message'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::where('id', $id)->first();
        if(!empty($message)){
            $message->audio_path = url($message->audio_path);
            $message->image_path = url($message->image_path);
            $message->compressed_image = url($message->compressed_image);
            $minister = $message->minister()->first();
            $minister->filepath = url($minister->filepath);
            $minister->compressed = url($minister->compressed);
            $message->minster = $minister;
            if(!empty($message->series_id)){
                $series = $message->series()->first();
            }
            if(isset($series)){
                $series->filepath = url($series->filepath);
                $series->compressed = url($series->compressed);
                $message->series = $series;
            }
            return response([
                'status' => 'success',
                'message' => 'Message found',
                'data' => $message
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Message Found',
                'data' => []
            ], 404);
        }
    }

    public function bySlug(Message $message, $slug)
    {
        $message = Message::where('slug', $slug)->first();
        if(!empty($message)){
            $message->audio_path = url($message->audio_path);
            $message->image_path = url($message->image_path);
            $message->compressed_image = url($message->compressed_image);
            $minister = $message->minister()->first();
            $minister->filepath = url($minister->filepath);
            $minister->compressed = url($minister->compressed);
            $message->minster = $minister;
            if(!empty($message->series_id)){
                $series = $message->series()->first();
            }
            if(isset($series)){
                $series->filepath = url($series->filepath);
                $series->compressed = url($series->compressed);
                $message->series = $series;
            }
            return response([
                'status' => 'success',
                'message' => 'Message found',
                'data' => $message
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Message Found',
                'data' => []
            ], 404);
        }
    }

    public function search($search){
        $search_array = explode(' ', $search);
        foreach($search_array as $search){
            if(($search != 'a') && ($search != 'an') && ($search != 'the') && ($search != 'is') && ($search != 'of') && ($search != 'with')
            && ($search != 'are') && ($search != 'was') && ($search != 'were') && ($search != 'for') && ($search != 'on') && ($search != 'to')
            && ($search != 'on') && ($search != 'Rev\'d')){
                $messages = Message::where('details', 'like', '%'.$search.'%');
                if($messages->count() > 0){
                    return response([
                        'status' => 'success',
                        'message' => 'Search Param Valid'
                    ], 200);
                    exit;
                }
            }
        }
        return response([
            'status' => 'failed',
            'message' => 'No Message was found'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, $id)
    {
        $message = Message::find($id);
        if($message){
            $all = $request->all();
            if(!empty($all['image_path'])){
                $image = $all['image_path'];
                unset($all['image_path']);
                if($image instanceof UploadedFile){
                    FileController::delete_file($message->image_path);
                    FileController::delete_file($message->compressed_image);
                    
                    $upload = FileController::uploadfile($image, 'messages');
                    if($upload){
                        $all['image_path'] = 'img/messages/'.$upload;
                        $all['compressed_image'] = 'img/messages/compressed/'.$upload;
                    }
                }
            } else {
                unset($all['image_path']);
            }
            if(!empty($all['audio_path'])){
                $audio = $all['audio_path'];
                unset($all['audio_path']);
                if($audio instanceof UploadedFile){
                    FileController::delete_file($message->audio_path);
                    
                    $upload = FileController::uploadfile($audio, 'messages');
                    if($upload){
                        $all['audio_path'] = 'audio/messages/'.$upload;
                    }
                }
            } else {
                unset($all['audio_path']);
            }
            $series = Series::where('id', $all['series_id'])->first();
            $minister = Minister::where('id', $all['minister_id'])->first();
            $all['details'] = $all['title'].' '.$all['description'].' '.$series->title.' '.$minister->name.' '.date('l, jS \of F, Y');
            if($message->update($all)){
                $message->image_path = url($message->image_path);
                $message->compressed_image = url($message->compressed_image);
                $message->audio_path = url($message->audio_path);
                return response([
                    'status' => 'success',
                    'message' => 'Message updated successfully',
                    'data' => $message
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'There was an error updatinf message'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Message not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message, $id)
    {
        $message = Message::where('id', $id)->first();
        if($message){
            FileController::delete_file($message->image_path);
            FileController::delete_file($message->compressed_image);
            FileController::delete_file($message->audio_path);
            $message->delete();
            return response([
                'status' => 'success',
                'message' => 'Message Deleted successfully',
                'data' => $message
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Message failed to delete successfully',
            ], 404);
        }
    }
}
