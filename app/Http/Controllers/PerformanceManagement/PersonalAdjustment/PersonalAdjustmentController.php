<?php

namespace App\Http\Controllers\PerformanceManagement\PersonalAdjustment;

use App\Http\Controllers\Controller;
use App\Contracts\ChannelContract;
use Session;
use Illuminate\Http\Request;

class PersonalAdjustmentController extends Controller
{
    
    protected $channelRepository;

    public function __construct(ChannelContract $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    public function index()
    {
        // echo "<pre>";print_r($available_channels);echo "</pre>";exit;
        return view('pages.performance-management.personal-adjustment.index');
    }


}
