<?php

namespace App\Http\Controllers\PerformanceManagement\Reconciliation;

use App\Http\Controllers\Controller;
use App\Contracts\ChannelContract;
use Session;
use Illuminate\Http\Request;

class ReconciliationController extends Controller
{
    
    public function index()
    {
        // echo "<pre>";print_r($available_channels);echo "</pre>";exit;
        return view('pages.performance-management.reconciliation.index');
    }


}
