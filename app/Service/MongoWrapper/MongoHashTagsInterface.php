<?php
/**
 * Created by PhpStorm.
 * User: drazen.popov
 * Date: 12/16/2016
 * Time: 10:32 AM
 */

namespace App\Service\MongoWrapper;

interface MongoHashTagsInterface
{
	public function insertManyHashTags($data);
	public function insertManyUniqueHashTags($data);
}