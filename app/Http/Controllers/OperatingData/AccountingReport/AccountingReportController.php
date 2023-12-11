<?php

namespace App\Http\Controllers\OperatingData\AccountingReport;

use App\Http\Controllers\Controller;
use App\Contracts\ChannelContract;
use App\Contracts\ChannelGroupContract;
use Session;
use Illuminate\Http\Request;

class AccountingReportController extends Controller
{
    
    protected $channelRepository;
    protected $channelGroupRepository;

    public function __construct(ChannelContract $channelRepository, ChannelGroupContract $channelGroupRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->channelGroupRepository = $channelGroupRepository;
    }

    public function index()
    {
        $available_channels = $this->channelRepository->getAll($display_in_menu = 1);

        
        $channel = $this->channelRepository->findChannelById(1);
        $available_regions = $channel->relatedRegion;

        // $channel_groups = $this->channelGroupRepository->getAllByChannelAndRegion(null, 1, $available_regions[0]->id);

        $channel_groups = $channel->channelGroups;

        // echo "<pre>";print_r($available_channels);echo "</pre>";exit;
        return view('pages.operating-data.accounting-report.index',['available_channels'=>$available_channels, 'available_regions'=>$available_regions, 'channel_groups'=>$channel_groups]);
    }


}
