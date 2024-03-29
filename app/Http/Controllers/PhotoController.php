<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos_data = Photo::orderBy('created_at', 'desc');
        if($photos_data->count() > 0){
            $photos = $photos_data->paginate();
            foreach($photos as $photo){
                $photo->filepath = url($photo->filepath);
                $photo->compressed = url($photo->compressed);
            }
            return response([
                'status' => 'success',
                'message' => 'Photos found successfully',
                'data' => $photos
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Photo found',
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
     * @param  \App\Http\Requests\StorePhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhotoRequest $request)
    {
        $all = $request->all();
        $image = $all['filepath'];
        unset($all['filepath']);
        $upload = FileController::uploadfile($image, 'photos');
        if($upload){
            $all['filepath'] = 'img/photos/'.$upload;
            $all['compressed'] = 'img/photos/compressed/'.$upload;
        }
        $all['all_details'] = $all['caption'].' '.$all['details'];
        $photo = Photo::create($all);
        if($photo){
            $photo->filepath = url($photo->filepath);
            $photo->compressed = url($photo->compressed);
            return response([
                'status' => 'success',
                'message' => 'Photos uploaded successfully',
                'data' => $photo
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Photo upload Error'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo, $id)
    {
        $photo = Photo::where('id', $id)->first();
        if(!empty($photo)){
            $photo->filepath = url($photo->filepath);
            $photo->compressed = url($photo->compressed);
            return response([
                'status' => 'success',
                'message' => 'Photo fetched successfully',
                'data' => $photo
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Photo not found',
                'data' => []
            ], 404);
        }
    }

    public function bySlug(Photo $photo, $slug)
    {
        $photo = Photo::where('slug', $slug)->first();
        if(!empty($photo)){
            $photo->filepath = url($photo->filepath);
            $photo->compressed = url($photo->compressed);
            return response([
                'status' => 'success',
                'message' => 'Photo fetched successfully',
                'data' => $photo
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Photo not found',
                'data' => []
            ], 404);
        }
    }
    
    public function search($search){
        $search_array = explode(' ', $search);
        foreach($search_array as $search){
            if(($search != 'a') && ($search != 'an') && ($search != 'the') && ($search != 'is') && ($search != 'of') && ($search != 'with')
            && ($search != 'are') && ($search != 'was') && ($search != 'were') && ($search != 'for') && ($search != 'on') && ($search != 'to')
            && ($search != 'on') && ($search != 'Rev\'d') && ($search != 'the')){
                $photos = Photo::where('all_details', 'like', '%'.$search.'%');
                if($photos->count() > 0){
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
            'message' => 'No Photo was found'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhotoRequest  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhotoRequest $request, $id)
    {
        $photo = Photo::find($id);
        if($photo){
            $all = $request->all();
            if(!empty($all['filepath'])){
                $image = $all['filepath'];
                unset($all['filepath']);
                if($image instanceof UploadedFile){
                    FileController::delete_file($photo->filepath);
                    FileController::delete_file($photo->compressed);

                    $upload = FileController::uploadfile($image, 'photos');
                    if($upload){
                        $all['filepath'] = 'img/photos/'.$upload;
                        $all['compressed'] = 'img/photos/compressed/'.$upload;
                    }
                }
            } else {
                unset($all['filepath']);
            }
            $all['all_details'] = $all['caption'].' '.$all['details'];
            if($photo->update($all)){
                $photo->filepath = url($photo->filepath);
                $photo->compressed = url($photo->compressed);
                return response([
                    'status' => 'success',
                    'message' => 'Photo details updated',
                    'data' => $photo
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Error in photo update'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Photo not found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        if($photo->delete()){
            FileController::delete_file($photo->filepath);
            FileController::delete_file($photo->compressed);
            return response([
                'status' => 'success',
                'message' => 'Photo deleted successfully',
                'data' => $photo
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Photo Delete failed'
            ], 500);
        }
    }
}
