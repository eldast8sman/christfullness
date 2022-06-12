<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::orderBy('created_at', 'desc')->paginate();
        if(!empty($videos)){
            return response([
                'status' => 'success',
                'message' => 'Videos successfully found',
                'data' => $videos
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Video was found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {
        $video = Video::create($request->all());
        if($video){
            return response([
                'status' => 'success',
                'message' => 'Video added successfully',
                'data' => $video
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Error in adding Video'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video, $id)
    {
        $video = Video::where('id', $id)->first();
        if(!empty($video)){
            return response([
                'status' => 'success',
                'message' => 'Video fetched successfully',
                'data' => $video
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Video was fetched',
                'data' => []
            ], 404);
        }
    }

    /**
     * Show a the specified resource by Slug
     */
    public function bySlug(Video $video, $slug)
    {
        $video = Video::where('slug', $slug)->first();
        if(!empty($video)){
            return response([
                'status' => 'success',
                'message' => 'Video fetched successfully',
                'data' => $video
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Video was fetched',
                'data' => []
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVideoRequest  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVideoRequest $request, $id)
    {
        $video = Video::find($id);
        if($video){
            if($video->update($request->all())){
                return response([
                    'status' => 'success',
                    'message' => 'Video Updated successfully',
                    'data' => $video
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Video update failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Video was fetched',
                'data' => []
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video, $id)
    {
        $video = Video::find($id);
        if($video){
            $video->delete();
            return response([
                'status' => 'success',
                'message' => 'Video successfully deleted',
                'data' => $video
            ], 204);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Video was not found',
                'data' => [] 
            ], 404);
        }
    }
}
