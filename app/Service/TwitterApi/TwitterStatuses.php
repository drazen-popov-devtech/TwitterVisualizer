<?php
/**
 * Created by PhpStorm.
 * User: drazen.popov
 * Date: 12/14/2016
 * Time: 4:13 PM
 */

namespace App\Service\TwitterApi;


class TwitterStatuses implements TwitterStatusesInterface
{
	/**
	 * @var TwitterStatusesInterface
	 */
	public $repository;

	/**
	 * TwitterStatuses constructor.
	 * @param TwitterStatusesInterface $repository
	 */
	public function __construct(TwitterStatusesInterface $repository)
	{
		$this->repository = $repository;
	}

	public function get($search)
	{
		return $this->repository->get($search);
	}
}