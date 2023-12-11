<?php

namespace App\Http\Controllers\AdSchedule\Booking;

use App\Http\Controllers\Controller;
use App\Contracts\ChannelContract;
use App\Contracts\RegionContract;

class BookingController extends Controller
{
    protected $channelRepository;
    protected $regionRepository;

    public function __construct(ChannelContract $channelRepository, RegionContract $regionRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->regionRepository = $regionRepository;
    }
    
    public function index()
    {
        $available_channels = $this->channelRepository->getAll($display_in_menu = 1);

        return view('pages.ad-schedule.booking.index',['available_channels'=>$available_channels]);
    }

}
