<?php

namespace App\Http\Controllers\PerformanceManagement\Summary;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    
    
    public function index()
    {
        return view('pages.performance-management.summary.index');
    }


}
