<?php

namespace App\Http\Controllers\PerformanceManagement\Team;

use App\Http\Controllers\Controller;
use App\Contracts\ChannelContract;
use Session;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    
    protected $channelRepository;

    public function __construct(ChannelContract $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    public function index()
    {
        return view('pages.performance-management.team.index');
    }


}
