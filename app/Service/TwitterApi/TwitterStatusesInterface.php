<?php
/**
 * Created by PhpStorm.
 * User: drazen.popov
 * Date: 12/15/2016
 * Time: 2:18 PM
 */

namespace App\Service\TwitterApi;

interface TwitterStatusesInterface
{
	public function get($search);
}