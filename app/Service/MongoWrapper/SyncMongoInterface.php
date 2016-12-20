<?php
/**
 * Created by PhpStorm.
 * User: drazen.popov
 * Date: 12/19/2016
 * Time: 3:33 PM
 */

namespace App\Service\MongoWrapper;

interface SyncMongoInterface
{
	public function syncHashTagsCounter();
}