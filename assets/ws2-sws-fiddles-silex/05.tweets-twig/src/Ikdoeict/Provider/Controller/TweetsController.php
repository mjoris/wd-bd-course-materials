<?php

namespace Ikdoeict\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class TweetsController implements ControllerProviderInterface {


	/** @var arra The tweets */
	protected $data;


	/**
	 * Constructor
	 * @param array $data Data holding the tweets
	 */
	function __construct($data) {
		$this->data = $data;
	}


	/**
	 * Returns routes to connect to the given application.
	 * @param Application $app An Application instance
	 * @return ControllerCollection A ControllerCollection instance
	 */
	public function connect(Application $app) {

		//@note $app['controllers_factory'] is a factory that returns a new instance of ControllerCollection when used.
		//@see http://silex.sensiolabs.org/doc/organizing_controllers.html
		$controllers = $app['controllers_factory'];

		// Bind sub-routes
		$controllers->get('/', array($this, 'overview'));
		$controllers->get('/{id}/', array($this, 'detail'))->assert('id', '\d+');

		return $controllers;

	}


	/**
	 * Tweet Overview
	 * @param Application $app An Application instance
	 * @return string A blob of HTML
	 */
	public function overview(Application $app) {

		// Inject data into the template which will show 'm all
		return $app['twig']->render('tweets/overview.twig', array('tweets' => $this->data));

	}

	/**
	 * Tweet Detail
	 * @param Application $app An Application instance
	 * @param int $id ID of the tweet (URL Param)
	 * @return string A blob of HTML
	 */
	public function detail(Application $app, $id) {

		// Make sure the given tweet id exists
		if (!in_array($id, array_column($this->data, 'id'))) {
			$app->abort(404, "Tweet $id does not exist");
		}

		// Extract the tweet by filtering the tweets array based on the value of the id key
		$tweets = array_filter($this->data, function($tweet) use ($id) { return $tweet['id'] == $id; });
		$tweet = array_pop($tweets);

		// Build and return the HTML representing the tweet
		return $app['twig']->render('tweets/detail.twig', array('tweet' => $tweet));

	}

}