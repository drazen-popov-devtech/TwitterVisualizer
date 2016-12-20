<?php

namespace App\Providers;

use App\Service\MongoWrapper\MongoHashTagsInterface;
use App\Service\MongoWrapper\MongoServiceInterface;
use App\Service\MongoWrapper\MongoTwitterVisualizerWrapper;
use App\Service\MongoWrapper\Repository as MongoRepository;
use App\Service\MongoWrapper\SyncMongoInterface;
use App\Service\TwitterApi\Repository as TwitterStatuses;
use App\Service\TwitterApi\TwitterStatusesInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TwitterStatusesInterface::class, TwitterStatuses::class);
        $this->app->bind(MongoHashTagsInterface::class, MongoRepository::class);
        $this->app->bind(MongoServiceInterface::class, MongoTwitterVisualizerWrapper::class);
        $this->app->bind(SyncMongoInterface::class, MongoTwitterVisualizerWrapper::class);
    }
}
