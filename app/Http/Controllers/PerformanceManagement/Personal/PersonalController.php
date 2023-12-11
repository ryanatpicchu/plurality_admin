<?php

namespace App\Http\Controllers\PerformanceManagement\Personal;

use App\Http\Controllers\Controller;
use App\Contracts\ChannelContract;
use Session;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    
    protected $channelRepository;

    public function __construct(ChannelContract $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    public function index()
    {
        $available_channels = $this->channelRepository->getAll($display_in_menu = 1);

        // echo "<pre>";print_r($available_channels);echo "</pre>";exit;
        return view('pages.performance-management.personal.index',['available_channels'=>$available_channels]);
    }


}
