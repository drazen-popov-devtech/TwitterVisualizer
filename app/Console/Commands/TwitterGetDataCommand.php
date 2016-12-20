<?php

namespace App\Console\Commands;

use App\Service\MongoWrapper\MongoServiceInterface;
use App\Service\TwitterApi\TwitterStatusesInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use MongoDB;


class TwitterGetDataCommand extends Command
{
    protected $search = ['cloud technologies', 'cloud', 'IT'];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from twitter API';

    /**
     * Inspire constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param TwitterStatusesInterface $requestStatuses
     * @param MongoServiceInterface $mongoDb
     */
    public function handle(TwitterStatusesInterface $requestStatuses, MongoServiceInterface $mongoDb)
    {

        foreach($this->search as $searchString){
            $hashTagsArray = $requestStatuses->get($searchString);

            $resultUnique = $mongoDb->createManyUniqueHashTags($hashTagsArray);
            $resultAll = $mongoDb->createManyHashTags($hashTagsArray);

            if($resultUnique == null){
                $resultUnique = 0;
            }
            Log::info("\r\n" . 'Inserted in hashTags collection : ' .$resultAll. "\r\n" .
                               'Inserted in unique hash tags collection : ' . $resultUnique);
        }
    }
}
