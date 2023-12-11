<?php

namespace App\Imports;

use App\Models\Channel;
use App\Models\Region;
use App\Models\ChannelRegion;
use App\Models\ChannelGroup;
use App\Models\ChannelGroupRegion;
use App\Models\Adslot;
use App\Models\AdslotGroup;
use App\Models\AdslotRegion;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Facades\App;

use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class Channel591SpecialImport implements ToModel, WithStartRow
{
    
    public function model(array $row)
    {   

        // echo $row[0]."\r\n";
        // echo $row[1]."\r\n";
        // echo $row[2]."\r\n";
        // echo $row[3]."\r\n";
        // Log::channel('dummyFile')->info($row[3]);

        $channel_name = $row[0];
        $channel_group_region_name = $row[1];
        $channel_group_name = $row[2];
        $adslot_group_name = $row[3];
        $spec = $row[4]."\r\n".$row[5];
        $repetitions = is_numeric(str_replace('R',"",$row[6]))?str_replace('R',"",$row[6]):0;
        $display_repetitions = $repetitions;
        $days = $row[7];
        $list_price = str_replace(',',"",$row[8]);
        $start_date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]));
        $end_date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10]));

        $display_type = 'banner';
        $profit_share_type = 'by_discount';
        $sale_status = 1;
        $pricing_method = $row[11];
        $note = $row[12];

        $adslot_group_id = '';
        $preview_image_id = 1;


        // find channel, if not exists, then create one

        $channel = Channel::where('name', $channel_name)->first();

        if(is_null($channel)){
            $channel = Channel::create(
                [
                    'order'       => Channel::count()+1,
                    'name'        => $channel_name,
                ]
            );
        }

        // find region, if not exists, then create one

        $region = Region::where('name', $channel_group_region_name)->first();

        if(is_null($region)){
            $region = Region::create(
                [
                    'order'       => Region::count()+1,
                    'name'        => $channel_group_region_name,
                ]
            );
        }

        // 關聯channel 與region
        // find channel_regions, if not exists, then create one
        $channel_region = ChannelRegion::where('channel_id', $channel->id)->where('region_id',$region->id)->first();

        if(is_null($channel_region)){
            $channel_region = ChannelRegion::create(
                [
                    'channel_id'       => $channel->id,
                    'region_id'        => $region->id
                ]
            );
        }

        // find channel group, if not exists, then create one
        $channel_group = ChannelGroup::where('channel_id', $channel->id)->where('name',$channel_group_name)->first();

        if(is_null($channel_group)){
            $channel_group = ChannelGroup::create(
                [
                    'order'       => ChannelGroup::count()+1,
                    'channel_id'  => $channel->id,
                    'name'        => $channel_group_name,
                    'type'        => 'special',
                    'created_by'  => 1
                ]
            );
        }

        // 關聯channel_group 與region
        // find channel_group_regions, if not exists, then create one
        $channel_group_region = ChannelGroupRegion::where('channel_group_id', $channel_group->id)->where('region_id',$region->id)->first();

        if(is_null($channel_group_region)){
            $channel_group_region = ChannelGroupRegion::create(
                [
                    'channel_group_id'       => $channel_group->id,
                    'region_id'        => $region->id
                ]
            );
        }

        // find adslot group, if not exists, then create one
        $adslot_group = AdslotGroup::where('channel_group_id', $channel_group->id)->where('name',$adslot_group_name)->first();

        if(is_null($adslot_group)){
            $adslot_group = AdslotGroup::create(
                [
                    'order'       => AdslotGroup::count()+1,
                    'name'        => $adslot_group_name,
                    'code'        => 'TEST' . (AdslotGroup::count()+1),
                    'channel_group_id'  => $channel_group->id,
                    'created_by'  => 1
                ]
            );
        }

        //create adslot
        
        $adslot = Adslot::create(
            [
                'order'       => Adslot::count()+1,
                'days'        => $days,
                'list_price'  => $list_price,
                'repetitions'  => $repetitions,
                'display_repetitions'  => $repetitions,
                'pricing_method'  => ($pricing_method == '天' || $pricing_method == '週')?'by_days':'by_quantities',
                'display_type'  => $display_type,
                'profit_share_type'  => $profit_share_type,
                'start_date'  => $start_date,
                'end_date'  => $end_date,
                'sale_status'  => $sale_status,
                'adslot_group_id'  => $adslot_group->id,
                'preview_image_id'  => $preview_image_id,
                'spec'  => $spec,
                'note'  => $note,
                'created_by'  => 1,

            ]
        );

        // 關聯adslot 與region
        // find channel_group_regions, if not exists, then create one
        $adslot_region = AdslotRegion::where('adslot_id', $adslot->id)->where('region_id',$region->id)->first();

        if(is_null($adslot_region)){
            $adslot_region = AdslotRegion::create(
                [
                    'adslot_id'       => $adslot->id,
                    'region_id'        => $region->id
                ]
            );
        }

        // echo "<pre>";print_r(Channel::count()+1);echo "</pre>";
        // echo "<pre>";print_r($channel_name);echo "</pre>";

        return;

        // return new Channel([
        //     'order'        => Channel::count()+1,
        //     'name'        => $channel_name,
        // ]);


        
    }

    /**
     * @return int
     * 從第二行開始讀。第一行是表頭
     */
    public function startRow(): int
    {
        return 2;
    }

}
