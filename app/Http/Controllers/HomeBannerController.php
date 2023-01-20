<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateHomeBannerRequest;
use App\Models\HomeBanner;
use Illuminate\Http\Request;

class HomeBannerController extends Controller
{
    public function update_banner(UpdateHomeBannerRequest $request){
        if(!empty($banner = HomeBanner::first())){
            $banner->update($request->all());
            return response([
                'status' => 'success',
                'message' => 'Home Banner successfully updated'
            ], 200);
        } else {
            $banner = HomeBanner::create($request->all());
            return response([
                'status' => 'success',
                'message' => 'Home Banner successfully created',
                'data' => $banner
            ], 200);
        }
    }
}
