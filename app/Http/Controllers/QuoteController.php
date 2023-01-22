<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequest;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class QuoteController extends Controller
{
    public function index(){
        $quotes = Quote::orderBy('created_at', 'desc');
        if($quotes->count() > 0){
            return response([
                'status' => 'success',
                'message' => 'Quotes fetched successfully',
                'data' => $quotes
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Quote was fetched'
            ], 404);
        }
    }

    public function store(StoreQuoteRequest $request){
        $file = $request->file('file');
        $all = $request->except(['file']);
        if($upload_image = FileController::uploadfile($file, 'quotes')){
            $all['filename'] = 'img/quotes/'.$upload_image;
            $all['compressed'] = 'img/quotes/compressed/'.$upload_image;

            if($quote = Quote::create($all)){
                $quote->filename = url($quote->filename);
                $quote->compressed = url($quote->compressed);

                return response([
                    'status' => 'success',
                    'message' => 'Quote uploaded successfully',
                    'data' => $quote
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Quote Upload Failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Picture uploade failed'
            ], 500);
        }
        
    }

    public function show($id){
        if(!empty($quote = Quote::find($id))){
            $quote->filename = url($quote->filename);
            $quote->compressed = url($quote->compressed);

            return response([
                'status' => 'success',
                'message' => 'Quote fetched successfully',
                'data' => $quote
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Quote was fetched'
            ], 404);
        }
    }

    public function update(StoreQuoteRequest $request, $id){
        if(!empty($quote = Quote::find($id))){
            $all = $request->except(['file']);
            if(!empty($file = $request->file('file'))){
                if($file instanceof UploadedFile){
                    if($upload = FileController::uploadfile($file, 'quotes')){
                        $all['filename'] = 'img/quotes/'.$upload;
                        $all['compressed'] = 'img/quotes/compressed/'.$upload;

                        FileController::delete_file($quote->filename);
                        FileController::delete_file($quote->compressed);
                    }
                }
            }
            if($quote->update($all)){
                $quote->filename = url($quote->filename);
                $quote->compressed = url($quote->compressed);

                return response([
                    'status' => 'success',
                    'message' => 'Quote fetched successfully',
                    'data' => $quote
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Quote Update Failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Quote was fetched'
            ], 404);
        }
    }

    public function destroy($id){
        if(!empty($quote = Quote::find($id))){
            if($quote->delete()){
                FileController::delete_file($quote->filename);
                FileController::delete_file($quote->compressed);

                return response([
                    'status' => 'success',
                    'message' => 'Quote successfully deleted',
                    'data' => $quote
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Qupte Deletion failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'No Quote was Fetched'
            ], 404);
        }
    }
}
