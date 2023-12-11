<?php

namespace App\Http\Controllers\AdSchedule\Package;

use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    
    public function list()
    {
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._package-list')->render();

        return json_encode($return);
    }

}
