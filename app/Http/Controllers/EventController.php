<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $events = Event::orderBy('created_at', 'desc');
        if($events->count() > 0){
            $events = $events->get();
            foreach($events as $event){
                $event->filename = url($event->filename);
                $event->compressed = url($event->compressed);
            }
            return response([
                'status' => 'success',
                'message' => 'Events fetched successfully',
                'data' => $events
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Event was fetched'
            ], 404);
        }
    }

    public function store(StoreEventRequest $request){
        $all = $request->except(['file']);
        if($upload = FileController::uploadfile($request->file, 'events')){
            $all['filename'] = 'img/events/'.$upload;
            $all['compressed'] = 'img/events/compressed/'.$upload;
        }
        $all['all_details'] = $all['event'].' '.$all['theme'].' '.$all['timing'].' '.$all['venue'].' '.date('l, jS F, Y', strtotime($all['start_date']));
        if(isset($all['end_date']) && !empty($all['end_date'])){
            $all['all_details'] .= ' '.date('l, jS F, Y', strtotime($all['end_date']));
        }

        if($event = Event::create($all)){
            $event->filename = url($event->filename);
            $event->compressed = url($event->compressed);

            return response([
                'status' => 'success',
                'message' => 'Event uploaded successfully',
                'data' => $event
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Event uploading failed'
            ], 500);
        }
    }

    public function show($id){
        if(!empty($event = Event::find($id))){
            $event->filename = url($event->filename);
            $event->compressed = url($event->compressed);

            return response([
                'status' => 'success',
                'message' => 'Event fetched successfully',
                'data' => $event
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Event was fetched'
            ], 404);
        }
    }

    public function bySlug($slug){
        if(!empty($event = Event::where('slug', $slug)->first())){
            $event->filename = url($event->filename);
            $event->compressed = url($event->compressed);

            return response([
                'status' => 'success',
                'message' => 'Event fetched successfully',
                'data' => $event
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Event was fetched'
            ], 404);
        }
    }

    public function update(UpdateEventRequest $request, $id){
        if(!empty($event = Event::find($id))){
            $all = $request->except(['file']);
            if(isset($request->file) && !empty($request->file)){
                if($upload = FileController::uploadfile($request->file, 'events')){
                    $all['filename'] = 'img/events/'.$upload;
                    $all['compressed'] = 'img/events/compressed/'.$upload;

                    if(!empty($event->filename)){
                        FileController::delete_file($event->filename);
                        FileController::delete_file($event->compressed);
                    }
                }
                $all['all_details'] = $all['event'].' '.$all['theme'].' '.$all['timing'].' '.$all['venue'].' '.date('l, jS F, Y', strtotime($all['start_date']));
                if(isset($all['end_date']) && !empty($all['end_date'])){
                    $all['all_details'] .= ' '.date('l, jS F, Y', strtotime($all['end_date']));
                }

                if($event->update($all)){
                    $event->filename = url($event->filename);
                    $event->compressed = url($event->compressed);
                    return response([
                        'status' => 'success',
                        'message' => 'Event Updated successfully',
                        'data' => $event
                    ], 200);
                } else {
                    return response([
                        'status' => 'failed',
                        'message' => 'Event Update failed'
                    ], 500);
                }
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Event was fetched'
            ], 404);
        }
    }

    public function destroy($id){
        if(!empty($event = Event::find($id))){
            if($event->delete()){
                if(!empty($event->filename)){
                    FileController::delete_file($event->filename);
                    FileController::delete_file($event->compressed);
                }

                return response([
                    'status' => 'success',
                    'message' => 'Event deleted successfully',
                    'data' => $event
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Event deletion failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Event not found'
            ], 404);
        }
    }
}
