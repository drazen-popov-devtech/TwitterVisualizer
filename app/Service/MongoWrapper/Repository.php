<?php
/**
 * Created by PhpStorm.
 * User: drazen.popov
 * Date: 12/16/2016
 * Time: 10:24 AM
 */

namespace App\Service\MongoWrapper;

use MongoDB\BSON\UTCDatetime;
use MongoDB\Client;
use MongoDB\Model\BSONDocument;

class Repository implements MongoHashTagsInterface
{
	/**
	 * @var Client
	 */
	private $mongoClient;

	/**
	 * @var \MongoDB\Database
	 */
	protected $db;

	/**
	 * MongoTwitterVisualizerWrapper constructor.
	 * @param Client $mongoClient
	 */
	public function __construct(Client $mongoClient)
	{
		$this->mongoClient = $mongoClient;
		$this->db = $mongoClient
			->selectDatabase('twitter_visualizer');
	}

	/**
	 * @param $hashTagsArray
	 * @return int
	 */
	public function insertManyHashTags($hashTagsArray)
	{
		$insertArray = [];

		foreach($hashTagsArray as $hashTag){
			$insertArray[] = ['hashTag'    =>$hashTag,
				              'timeStamp' => new UTCDatetime(microtime(true) * 1000)];
		}

		$collection = $this->db->selectCollection('hashTags');
		if($insertArray) {
			$result = $collection->insertMany($insertArray);
			return $result->getInsertedCount();
		}
	}

	/**
	 * @param $hashTagsArray
	 * @return int
	 */
	public function insertManyUniqueHashTags($hashTagsArray)
	{
		$insertArray = [];

		foreach(array_unique($hashTagsArray) as $hashTag){

			/** @var BSONDocument $result */
			$result = $this->getOne($hashTag, 'uniqueHashTags');

			if(!$result){
				$insertArray[] = ['hashTag'    => $hashTag,
								  'timeStamp' => new UTCDatetime(microtime(true) * 1000)];
			}
		}
		if($insertArray) {
			$collection = $this->db->selectCollection('uniqueHashTags');
			$resultMany = $collection->insertMany($insertArray);
			return $resultMany->getInsertedCount();
		}
	}

	/**
	 * Updates hash tags counter
	 */
	public function updateHashTagsCounter()
	{
		$hashTags = $this->getAllUniqueHashTags();
		$hashTagCountArray = [];
		foreach($hashTags as $hashTag)
		{
			$hashTagCountArray[] = $this->getHashTagsCount($hashTag);
		}

		$this->updateCount($hashTagCountArray);
	}

	/**
	 * @return array
	 */
	public function getHashTags()
	{
		$collection = $this->db->selectCollection('uniqueHashTags');

		return $collection->find([],['projection'=>['_id'=>0],'sort'=>['counter'=>-1], 'limit'=>30])->toArray();
	}

	/**
	 * @param $hashTag
	 * @return array
	 */
	private function getHashTagsCount($hashTag)
	{
		$collection = $this->db->selectCollection('hashTags');
		return ['hashTag'=> $hashTag['hashTag'], 'counter'=>$collection->count(['hashTag'=> $hashTag['hashTag']])];
	}

	/**
	 * @return array
	 */
	private function getAllUniqueHashTags()
	{
		$collection = $this->db->selectCollection('uniqueHashTags');
		return $collection->find()->toArray();

	}

	/**
	 * @param $hashTag
	 * @param $collectionName
	 * @return array|null|object
	 */
	private function getOne($hashTag, $collectionName)
	{
		$collection = $this->db->selectCollection($collectionName);
		return $collection->findOne(['hashTag' => $hashTag]);
	}

	/**
	 * @param $hashTags
	 */
	private function updateCount($hashTags)
	{
		$collection = $this->db->selectCollection('uniqueHashTags');
		foreach($hashTags as $hashTag)
		{
			$collection->updateOne(['hashTag'=>$hashTag{'hashTag'}], ['$set'=>['counter'=>$hashTag['counter']]]);
		}
	}

}