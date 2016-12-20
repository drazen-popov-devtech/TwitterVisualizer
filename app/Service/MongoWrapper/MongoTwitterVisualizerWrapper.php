<?php

/**
 * Created by PhpStorm.
 * User: drazen.popov
 * Date: 12/15/2016
 * Time: 11:27 AM
 */

namespace App\Service\MongoWrapper;


class MongoTwitterVisualizerWrapper implements MongoServiceInterface
{
	/** @var Repository  */
	protected $hashTagsRepository;

	/**
	 * MongoTwitterVisualizerWrapper constructor.
	 * @param MongoHashTagsInterface $hashTagsRepository
	 * @internal param MongoHashTagsInterface $hashTags
	 */
	public function __construct(MongoHashTagsInterface $hashTagsRepository)
	{
		$this->hashTagsRepository = $hashTagsRepository;
	}

	/**
	 * @param $data
	 * @return int
	 */
	public function createManyHashTags($data)
	{
		return $this->hashTagsRepository->insertManyHashTags($data);
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	public function createManyUniqueHashTags($data)
	{
		return $this->hashTagsRepository->insertManyUniqueHashTags($data);
	}

	/**
	 * Updates counters on hash tags collection
	 */
	public function syncHashTagsCounter()
	{
		$this->hashTagsRepository->updateHashTagsCounter();
	}

	/**
	 * Returnes hashTags array with counters
	 * @return array
	 */
	public function getHashTags()
	{
		return $this->hashTagsRepository->getHashTags();
	}
}