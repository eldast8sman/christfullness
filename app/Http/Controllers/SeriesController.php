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

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Series::orderBy('created_at', 'DESC');
        if($series->count() > 0){
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
        if($image instanceof UploadedFile){
            $filename = Str::random()."_".$image->getClientOriginalName();
            $image->move(public_path('img'), $filename);
            $all['filepath'] = ('img/'.$filename);
            $Image = Image::make($all['filepath']);
            $Image->resize(50, null, function($constraint){
                $constraint->aspectRation();
                $constraint->upsize();
            })->save(public_path('compressed_img/'.$filename));
            $all['compressed'] = public_path('compressed_img/'.$filename);
        }
        $series = Series::create($all);
        if($series){

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
        if($series){
            $series->messages = $this->messages;
            return response()->json([
                'status' => 'success',
                'message' => 'Series found successfully',
                'data' => $series
            ])->status(200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Series not found',
                'data' => []
            ])->status(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSeriesRequest  $request
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeriesRequest $request, Series $series)
    {
        $series = Series::find($series);
        if($series){
            $all = $request->all();
            if(!empty($all['filepath'])){
                $image = $all['filepath'];
                unset($all['filepath']);
                if($image instanceof UploadedFile){
                    if(File::exists($series->filepath)){
                        File::delete($series->filepath);
                    }
                    $filename = Str::random()."_".$image->getClientOriginalName();
                    $image->move(public_path('img'), $filename);
                    $all['filepath'] = $filename;
                    $Image = Image::make($all['filepath']);
                    $Image->resize(50, null, function($constraint){
                        $constraint->aspectRation();
                        $constraint->upsize();
                    })->save(public_path('compressed_img/'.$filename));
                    $all['compressed'] = public_path('compressed_img/'.$filename);
                }
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
            if(!empty($series->messages)){
                foreach($series->messages as $message){
                    $message->delete();
                }
                if(File::exists($series->filepath)){
                    File::delete($series->filepath);
                }
                if(File::exists($series->compressed)){
                    File::delete($series->compressed);
                }
            }
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
