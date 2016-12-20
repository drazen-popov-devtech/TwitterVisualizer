<?php

namespace App\Http\Controllers;



use App\Service\MongoWrapper\MongoServiceInterface;
use App\Service\MongoWrapper\MongoTwitterVisualizerWrapper;

class HomeController extends Controller
{
	/**
	 * @var MongoTwitterVisualizerWrapper
	 */
	private $mongo;

	/**
	 * HomeController constructor.
	 * @param MongoServiceInterface $mongo
	 */
	public function __construct(MongoServiceInterface $mongo)
	{
		$this->mongo = $mongo;
	}

	public function home()
	{
		$hashTags = $this->mongo->getHashTags();
		$fontSize = 40;
		foreach($hashTags as $hashTag){
			$fontSize-=1;
			$hashTag ['hashTagsWithFontSize'] = $fontSize;
		}
		return view('home')->with('hashTags', $hashTags);
	}
}
