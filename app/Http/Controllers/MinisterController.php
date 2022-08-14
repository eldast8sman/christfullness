<?php

namespace App\Http\Controllers;

use App\Models\Minister;
use App\Http\Requests\StoreMinisterRequest;
use App\Http\Requests\UpdateMinisterRequest;

class MinisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ministers = Minister::orderBy('appearance', 'asc');
        if($ministers->count() > 0){
            $all_mins = $ministers->get();
            foreach($all_mins as $minister){
                $minister->filepath = url($minister->filepath);
                $minister->compressed = url($minister->compressed);
            }
            return response([
                'status' => 'success',
                'message' => 'Ministers fetched successfully',
                'data' => $all_mins
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Message was found',
                'data' => []
            ], 404);
        }
    }

    public function internalMinisters(){
        $ministers = Minister::where('status', true)->orderBy('appearance', 'asc')->orderBy('updated_at', 'desc');
        if($ministers->count() > 0){
            $all_mins = $ministers->get();
            foreach($all_mins as $minister){
                $minister->filepath = url($minister->filepath);
                $minister->compressed = url($minister->compressed);
            }
            return response([
                'status' => 'success',
                'message' => 'Ministers fetched successfully',
                'data' => $all_mins
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Message was found',
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
     * @param  \App\Http\Requests\StoreMinisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMinisterRequest $request)
    {
        $all = $request->all();
        $image = $all['filepath'];
        unset($all['filepath']);
        $upload = FileController::uploadfile($image, 'ministers');
        if($upload){
            $all['filepath'] = 'img/ministers/'.$upload;
            $all['compressed'] = 'img/ministers/compressed/'.$upload;
        }
        
        $minister = Minister::create($all);
        if($minister){
            $minister->filepath = url($minister->filepath);
            $minister->compressed = url($minister->compressed);
            return response([
                'status' => 'success',
                'message' => 'Minister successfully Added',
                'data' => $minister
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Minister was not created'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Minister  $minister
     * @return \Illuminate\Http\Response
     */
    public function show(Minister $minister, $id)
    {
        $minister = Minister::where('id', $id)->first();
        if(!empty($minister)){
            $minister->filepath = url($minister->filepath);
            $minister->compressed = url($minister->compressed);
            return response([
                'status' => 'success',
                'message' => 'Minister Fetched Successfully',
                'data' => $minister
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Minister Not Found',
            ], 404);
        }
    }

    public function bySlug(Minister $minister, $slug){
        $minister = Minister::where('slug', $slug)->first();
        if(!empty($minister)){
            $minister->filepath = url($minister->filepath);
            $minister->compressed = url($minister->compressed);
            return response([
                'status' => 'success',
                'message' => 'Minister Found Successfully',
                'data' => $minister
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Minister Not Found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Minister  $minister
     * @return \Illuminate\Http\Response
     */
    public function edit(Minister $minister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMinisterRequest  $request
     * @param  \App\Models\Minister  $minister
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMinisterRequest $request, $id)
    {
        $minister = Minister::find($id);
        if($minister){
            $all = $request->all();
            if(!empty($all['filepath'])){
                $image = $all['filepath'];
                unset($all['filepath']);
                $upload = FileController::uploadfile($image, 'ministers');
                if($upload){
                    FileController::delete_file($minister->filepath);
                    FileController::delete_file($minister->compressed);
                    
                    $all['filepath'] = 'img/ministers/'.$upload;
                    $all['compressed'] = 'img/ministers/compressed/'.$upload;
                }
            } else {
                unset($all['filepath']);
            }
            if($minister->update($all)){
                $minister->filepath = url($minister->filepath);
                $minister->compressed = url($minister->compressed);
                return response([
                    'status' => 'success',
                    'message' => 'Minister Updated Successfully',
                    'data' => $minister
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Error in updating Minister'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Minister Not Found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Minister  $minister
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $minister = Minister::find($id);
        if($minister){
            if($minister->messages()->count() > 0){
                foreach($minister->messages() as $message){
                    FileController::delete_file($message->image_path);
                    FileController::delete_file($message->compressed_image);
                    FileController::delete_file($message->audio_path);
                    $message->delete();
                }
            }
            
            FileController::delete_file($minister->filepath);
            FileController::delete_file($minister->compressed);
            
            $minister->delete();
            return response([
                'status' => 'success',
                'message' => 'Minister deleted successfully',
                'data' => $minister
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Miniter Delete Failed'
            ], 404);
        }
    }
}
