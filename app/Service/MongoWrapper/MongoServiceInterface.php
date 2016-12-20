<?php
/**
 * Created by PhpStorm.
 * User: drazen.popov
 * Date: 12/20/2016
 * Time: 10:39 AM
 */

namespace App\Service\MongoWrapper;

interface MongoServiceInterface
{
	public function createManyHashTags($data);
	public function createManyUniqueHashTags($data);
	public function getHashTags();
}