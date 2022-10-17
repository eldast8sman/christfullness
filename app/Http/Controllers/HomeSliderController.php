<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use App\Http\Requests\StoreHomeSliderRequest;
use App\Http\Requests\UpdateHomeSliderRequest;
use Illuminate\Http\UploadedFile;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = HomeSlider::orderBy('position', 'asc')->orderBy('updated_at', 'desc');
        if($sliders->count() > 0){
            $sliders = $sliders->get();
            foreach($sliders as $slider){
                $slider->filename = url($slider->filename);
                $slider->compressed = url($slider->compressed);
            }

            return response([
                'status' => 'success',
                'message' => 'Sliders fetched successfully',
                'data' => $sliders
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Slider was fetched for Home'
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
     * @param  \App\Http\Requests\StoreHomeSliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHomeSliderRequest $request)
    {
        $all = $request->all();
        $image = $all['filename'];
        unset($filename);
        $upload = FileController::uploadfile($image, 'sliders');
        if($upload){
            $all['filename'] = 'img/sliders/'.$upload;
            $all['compressed'] = 'img/sliders/compressed/'.$upload;
        }
        $slider = HomeSlider::create($all);
        if($slider){
            return response([
                'status' => 'success',
                'message' => 'Home Slider uploaded successfully',
                'data' => $slider
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Home Slider Upload failed'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  (int)$id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $homeSlider = HomeSlider::find($id);
        if(!empty($homeSlider)){
            $homeSlider->filename = url($homeSlider->filename);
            $homeSlider->compressed = url($homeSlider->compressed);
            return response([
                'status' => 'success',
                'message' => 'Home Slider fetched successfully',
                'data' => $homeSlider
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'HomeSlider not fetched'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeSlider $homeSlider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHomeSliderRequest  $request
     * @param  (int)$id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeSliderRequest $request, $id)
    {
        $slider = HomeSlider::find($id);
        if(!empty($slider)){
            $all = $request->all();
            if(!empty($all['filename'])){
                $image = $all['filename'];
                if($image instanceof UploadedFile){
                    FileController::delete_file($slider->filename);
                    FileController::delete_file($slider->compressed);

                    $upload = FileController::uploadfile($image, 'sliders');
                    if($upload){
                        $all['filename'] = 'img/sliders/'.$upload;
                        $all['compressed'] = 'img/photos/compressed'.$upload;
                    }
                }
            } else {
                unset($all['filename']);
            }
            if($slider->update($all)){
                $slider->filename = url($slider->filename);
                $slider->compressed = url($slider->compressed);
                return response([
                    'status' => 'success',
                    'message' => 'Slider updated successfully',
                    'data' => $slider
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Error in Slider Update'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Slider was fetched'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = HomeSlider::find($id);
        if($slider->delete()){
            FileController::delete_file($slider->filename);
            FileController::delete_file($slider->compressed);
            return response([
                'status' => 'success',
                'message' => 'Slider deleted successfully',
                'data' => $slider
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Slider Delete failed'
            ], 500);
        }
    }
}
