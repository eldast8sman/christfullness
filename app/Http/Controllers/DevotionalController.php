<?php

namespace App\Http\Controllers;

use App\Models\Devotional;
use App\Http\Requests\StoreDevotionalRequest;
use App\Http\Requests\UpdateDevotionalRequest;

class DevotionalController extends Controller
{
    /**
     * Returns the Devotional for Today.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devotionals  = Devotional::orderBy('devotional_date', 'desc');
        if($devotionals->count() > 0){
            return response([
                'status' => 'success',
                'message' => 'Devotionals fetched',
                'data' => $devotionals->get()
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Devotionals not found',
                'data' => []
            ], 404);
        }
    }
    
    public function todayDevotional()
    {
        $today = date('Y-m-d');
        $devotional = Devotional::where('devotional_date', $today)->first();
        if(!empty($devotional)){
            return response([
                'status' => 'success',
                'message' => 'Today\'s devotional fetched',
                'data' => $devotional
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Devotional for today'
            ], 404);
        }
    }

    public function previousDevotionals()
    {
        $today = date('Y-m-d');
        $devotionals = Devotional::where('devotional_date', '<', $today)
            ->orderBy('devotional_date', 'desc');
        if($devotionals->count() > 0){
            return response([
                'status' => 'success',
                'message' => 'Previous Devotionals fetched',
                'data' => $devotionals
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Previous Devotionals',
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
     * @param  \App\Http\Requests\StoreDevotionalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDevotionalRequest $request)
    {
        $devotional = Devotional::create($request->all());
        if($devotional){
            return response([
                'status' => 'success',
                'message' => 'Devotional created successfully',
                'data' => $devotional
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Devotion Creation Error'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devotional  $devotional
     * @return \Illuminate\Http\Response
     */
    public function show(Devotional $devotional, $id)
    {
        $devotional = Devotional::where('id', $id)->first();
        if(!empty($devotional)){
            return response([
                'status' => 'success',
                'message' => 'Devotional fetched successfully',
                'data' => $devotional
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Devotional not found'
            ], 404);
        }
    }

    public function bySlug(Devotional $devotional, $slug)
    {
        $devotional = Devotional::where('slug', $slug)->first();
        if(!empty($devotional)){
            return response([
                'status' => 'success',
                'message' => 'Devotional fetched successfully',
                'data' => $devotional
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Devotional not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devotional  $devotional
     * @return \Illuminate\Http\Response
     */
    public function edit(Devotional $devotional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDevotionalRequest  $request
     * @param  \App\Models\Devotional  $devotional
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDevotionalRequest $request, $id)
    {
        $devotional = Devotional::find($id);
        if($devotional){
            if($devotional->update($request->all())){
                return response([
                    'status' => 'success',
                    'message' => 'Devotional Update successful',
                    'data' => $devotional
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Devotional update Error'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Devotional not found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devotional  $devotional
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $devotional = Devotional::find($id);
        if($devotional){
            $devotional->delete();
            return response([
                'status' => 'success',
                'message' => 'Devotional Deleted successfully',
                'data' => $devotional
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Devotional not found',
                'data' => []
            ], 404);
        }
    }
}
