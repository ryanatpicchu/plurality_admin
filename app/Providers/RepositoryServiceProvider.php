<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\NewsContract;
use App\Repositories\NewsRepository;
use App\Contracts\ExhibitionContract;
use App\Repositories\ExhibitionRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        ChannelContract::class          =>          ChannelRepository::class,
        ChannelGroupContract::class     =>          ChannelGroupRepository::class,
        RegionContract::class           =>          RegionRepository::class,
        AdslotGroupContract::class      =>          AdslotGroupRepository::class,
        AdslotContract::class           =>          AdslotRepository::class,
        PreviewImageContract::class     =>          PreviewImageRepository::class,
        PerformanceAdContract::class     =>          PerformanceAdRepository::class,

        NewsContract::class             =>          NewsRepository::class,
        ExhibitionContract::class       =>          ExhibitionRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
    }
}