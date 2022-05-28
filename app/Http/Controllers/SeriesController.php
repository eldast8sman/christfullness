<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
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
        //
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
        }
        $series = Series::create($all);
        return new SeriesResource($series);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series)
    {
        //
    }
}
