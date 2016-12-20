<?php
/**
 * Created by PhpStorm.
 * User: drazen.popov
 * Date: 12/14/2016
 * Time: 1:56 PM
 */

namespace App\Listeners;

use App\TwitterVisualizer\Jobs\JobWasPosted;

class EmailNotifierListener
{
	public function whenJobWasPosted(JobWasPosted $event)
	{
		var_dump('Job je postovan'. $event->job->title);
	}
}