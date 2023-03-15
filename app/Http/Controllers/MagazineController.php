<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMagazineRequest;
use App\Http\Requests\UpdateMagazineRequest;
use App\Models\Magazine;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    public function index(){
        $magazines = Magazine::orderBy('created_at', 'desc');
        if($magazines->count() > 0){
            $magazines = $magazines->get();
            foreach($magazines as $magazine){
                $magazine->image_path = url($magazine->image_path);
                $magazine->compressed = url($magazine->compressed);
                $magazine->document_path = url($magazine->document_path);
            }
            return response([
                'status' => 'success',
                'message' => 'Magazines fetched successfully',
                'data' => $magazines
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Magazine not fetched'
            ], 404);
        }
    }

    public function store(StoreMagazineRequest $request){
        $all = $request->except(['image_file', 'pdf_file']);
        $all['all_details'] = $all['title'].' '.$all['summary'].' '.date('l jS \of F Y', strtotime($all['publication_date']));
        if($upload_image = FileController::uploadfile($request->image_file, 'magazines')){
            $all['image_path'] = 'img/magazines/'.$upload_image;
            $all['compressed'] = 'img/magazines/compressed/'.$upload_image;
            if($upload_book = FileController::uploadfile($request->pdf_file, 'magazines')){
                $all['document_path'] = 'document/magazines/'.$upload_book;

                if($magazine = Magazine::create($all)){
                    $magazine->image_path = url($magazine->image_path);
                    $magazine->compressed = url($magazine->compressed);
                    $magazine->document_path = url($magazine->document_path);

                    return response([
                        'status' => 'success',
                        'message' => 'Magazine uploaded successfully',
                        'data' => $magazine
                    ], 200);
                } else {
                    return response([
                        'status' => 'failed',
                        'message' => 'Magazine not uploaded'
                    ], 500);
                }
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'PDF not uploaded'
                ], 400);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Photo not uploaded'
            ], 400);
        }
    }

    public function show($id){
        if(!empty($magazine = Magazine::find($id))){
            $magazine->image_path = url($magazine->image_path);
            $magazine->compressed = url($magazine->compressed);
            $magazine->document_path = url($magazine->document_path);

            return response([
                'status' => 'success',
                'message' => 'Magazine fetched successfully',
                'data' => $magazine
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Magazine not found'
            ], 404);
        }
    }

    public function bySlug($slug){
        if(!empty($magazine = Magazine::where('slug', $slug)->first())){
            $magazine->image_path = url($magazine->image_path);
            $magazine->compressed = url($magazine->compressed);
            $magazine->document_path = url($magazine->document_path);

            return response([
                'status' => 'success',
                'message' => 'Magazine fetched successfully',
                'data' => $magazine
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Magazine not found'
            ], 404);
        }
    }

    public function search($search){
        $search_array = explode(' ', $search);
        foreach($search_array as $search){
            if(($search != 'a') && ($search != 'an') && ($search != 'the') && ($search != 'is') && ($search != 'of') && ($search != 'with')
            && ($search != 'are') && ($search != 'was') && ($search != 'were') && ($search != 'for') && ($search != 'on') && ($search != 'to')
            && ($search != 'on') && ($search != 'Rev\'d') && ($search != 'the')){
                $magazines = Magazine::where('all_details', 'like', '%'.$search.'%')->where('publication_date', '<=', date('Y-m-d'));
                if($magazines->count() > 0){
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

    public function update(UpdateMagazineRequest $request, $id){
        if(!empty($magazine = Magazine::find($id))){
            $all = $request->except(['image_file', 'pdf_file']);
            if(isset($request->image_file) && !empty($request->image_file)){
                if($upload = FileController::uploadfile($request->image_file, 'magazines')){
                    $all['image_path'] = 'img/magazines/'.$upload;
                    $all['compressed'] = 'img/magazines/compressed/'.$upload;
                }

                if(!empty($magazine->image_path)){
                    FileController::delete_file($magazine->image_path);
                    FileController::delete_file($magazine->compressed);
                }
            }
            if(isset($request->pdf_file) && !empty($request->pdf_file)){
                if($upload = FileController::uploadfile($request->pdf_file, 'magazines')){
                    $all['document_path'] = 'document/magazines/'.$upload;
                    
                    if(!empty($magazine->document_path)){
                        FileController::delete_file($magazine->document_path);
                    }
                }
            }

            if($magazine->update($all)){
                $magazine->image_path = url($magazine->image_path);
                $magazine->compressed = url($magazine->compressed);
                $magazine->document_path = url($magazine->document_path);

                return response([
                    'status' => 'success',
                    'message' => 'Magazine updated ssuccessfully',
                    'data' => $magazine
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Magazine Update Failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Magazine was fetched'
            ], 404);
        }
    }

    public function destroy($id){
        if(!empty($magazine = Magazine::find($id))){
            if($magazine->delete()){
                if(!empty($magazine->image_path)){
                    FileController::delete_file($magazine->image_path);
                    FileController::delete_file($magazine->compressed);
                }

                if(!empty($magazine->document_path)){
                    FileController::delete_file($magazine->document_path);
                }

                return response([
                    'status' => 'success',
                    'message' => 'Magazine deleted successfully',
                    'data' => $magazine
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Magazine deletion failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Magazine coule not be fetched'
            ]);
        }
    }
}
