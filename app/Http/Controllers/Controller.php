<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function paginate_array($array, $per_page=10, $page=null, $options=[]){
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $page = intval($page);
        $per_page = intval($per_page);
        $items = $array instanceof Collection ? $array : Collection::make($array);
        return new LengthAwarePaginator($items->forPage($page, $per_page), $items->count(), $per_page, $page, $options);
    }
}
