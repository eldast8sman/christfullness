<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Resources\SeriesResource;
use App\Http\Requests\StoreSeriesRequest;
use App\Http\Requests\UpdateSeriesRequest;
use App\Models\Minister;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series_data = Series::orderBy('created_at', 'DESC');
        if($series_data->count() > 0){
            $series = $series_data->get();
            foreach($series as $ser){
                $ser->filepath = url($ser->filepath);
                $ser->compressed = url($ser->compressed);
            }
            return response([
                'status' => 'success',
                'message' => 'Series found successfully',
                'data' => $series
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Series found',
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
     * @param  \App\Http\Requests\StoreSeriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeriesRequest $request)
    {
        $all = $request->all();
        $image = $all['filepath'];
        unset($all['filepath']);
        $upload = FileController::uploadfile($image, 'series');
        if($upload){
            $all['filepath'] = 'img/series/'.$upload;
            $all['compressed'] = 'img/series/compressed/'.$upload;
        }
        $series = Series::create($all);
        if($series){
            $series->filepath = url($series->filepath);
            $series->compressed = url($series->compressed);
            return response([
                'status' => 'success',
                'message' => 'Series created successfully',
                'data' => $series
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Series not created'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series, $slug)
    {
        $series = Series::where('slug', $slug)->first();
        if(!empty($series)){
            $series->messages = $series->messages();
            $series->filepath = url($series->filepath);
            $series->compressed = url($series->compressed);
            return response([
                'status' => 'success',
                'message' => 'Series found successfully',
                'data' => $series
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Series not found',
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
                $series = Series::where('title', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%');
                if($series->count() > 0){
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
            'message' => 'No Message Series was found'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSeriesRequest  $request
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeriesRequest $request, $id)
    {
        $series = Series::find($id);
        if($series){
            $all = $request->all();
            if(!empty($all['filepath'])){
                $image = $all['filepath'];
                unset($all['filepath']);
                if($image instanceof UploadedFile){
                    FileController::delete_file($series->filepath);
                    FileController::delete_file($series->compressed);
                    
                    $upload = FileController::uploadfile($image, 'series');
                    if($upload){
                        $all['filepath'] = 'img/series/'.$upload;
                        $all['compressed'] = 'img/series/compressed/'.$upload;
                    }
                }
            } else {
                unset($all['filepath']);
            }
            if($series->update($all)) {
                $series->filepath = url($series->filepath);
                $series->compressed = url($series->compressed);
                return response([
                    'status' => 'success',
                    'message' => 'Series updated successfully',
                    'data' => $series
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'An error occurred while updating',
                    'data' => $all
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Series not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series, $id)
    {
        $series = Series::find($id);
        if($series){
            if($series->messages()->count() > 0){
                foreach($series->messages() as $message){
                    FileController::delete_file($message->image_path);
                    FileController::delete_file($message->compressed_image);
                    FileController::delete_file($message->audio_path);
                    $message->delete();
                }                
            }
            FileController::delete_file($series->filepath);
            FileController::delete_file($series->compressed);
            $series->delete();
            return response([
                'status' => 'success',
                'message' => 'Series deleted successfully',
                'data' => $series
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Series failed to delete successfully',
            ], 404);
        }
    }
}
