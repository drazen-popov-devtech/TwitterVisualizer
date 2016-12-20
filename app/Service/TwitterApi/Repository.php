<?php
/**
 * Created by PhpStorm.
 * User: drazen.popov
 * Date: 12/15/2016
 * Time: 1:48 PM
 */

namespace App\Service\TwitterApi;


use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\Client;

class Repository implements TwitterStatusesInterface
{
	/**
	 * Twitter base URI
	 */
	const TWITTER_BASE_URI = 'https://api.twitter.com/1.1/';

	/**
	 * @var Client
	 */
	protected $client;

	/**
	 * @var HandlerStack
	 */
	protected $stack;

	/**
	 * Repository constructor.
	 */
	public function __construct()
	{
		$this->setStack();
		$this->setClient();
	}

	/**
	 * @param $search
	 * @return HandlerStack
	 */
	public function get($search)
	{
		$res = $this->client->request('GET','search/tweets.json?q='.$search);
		$hashTagsArray = [];

		$twitterData = \GuzzleHttp\json_decode($res->getBody()->getContents(), true)['statuses'];
		foreach($twitterData as $statuses)
		{
			foreach($statuses['entities']['hashtags'] as $text)
			{
				$hashTagsArray[] = $text['text'];
			}
		}

		return $hashTagsArray;
	}

	private function setStack()
	{
		$this->stack = HandlerStack::create();

		$middleware = new Oauth1([
			'consumer_key' => getenv('CONSUMER_KEY'),
			'consumer_secret' => getenv('CONSUMER_SECRET'),
			'token' => getenv('TOKEN'),
			'token_secret' => getenv('TOKEN_SECRET')
		]);

		$this->stack->push($middleware);
	}

	private function setClient()
	{
		$this->client = new Client([
			'base_uri' => Repository::TWITTER_BASE_URI,
			'timeout' => 5.0,
			'handler' => $this->stack,
			'auth' => 'oauth'
		]);
	}

}