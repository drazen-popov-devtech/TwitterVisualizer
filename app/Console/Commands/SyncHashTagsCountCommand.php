<?php

namespace App\Console\Commands;

use App\Service\MongoWrapper\MongoTwitterVisualizerWrapper;
use App\Service\MongoWrapper\SyncMongoInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use MongoDB;


class SyncHashTagsCountCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync data in database';

    /**
     * Inspire constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param SyncMongoInterface $mongoDb
     */
    public function handle(SyncMongoInterface $mongoDb)
    {
        $mongoDb->syncHashTagsCounter();
        Log::info('Db synchronized');
    }
}
