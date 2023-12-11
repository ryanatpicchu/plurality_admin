<?php

namespace App\Http\Controllers\PerformanceManagement\District;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    
    public function listDistrictPerformance()
    {
        
        $return = array();
        $return['modelContent'] = view('partials.modals.performance-management._list-districts-performance'
        )->render();

        return json_encode($return);
    }


}
