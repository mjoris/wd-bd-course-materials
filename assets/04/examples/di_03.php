<?php

require_once 'di_bootstrap.php';

// Very (very) simple DiC
class Container {

	protected $dependencies= [];

	public function get($name) {
		return isset($this->dependencies[$name]) ? (is_callable($this->dependencies[$name]) ? $this->dependencies[$name]() : $this->dependencies[$name]) : null;
	}

	public function set($name, $val) {
		$this->dependencies[$name] = $val;
	}

	// @note: yes, we could use __set() and __call here, I know.

}

class Router {

	protected $request;
	protected $response;

	public function __construct(Request $request, Response $response, $path) {
		$this->request = $request;
		$this->response = $response;
		$this->path = $path;
		// &hellip;
	}

}

// Create DiC
$container = new Container();

// Tell DiC how to create dependencies
$container->set('request', function() {
	return new Request();
});
$container->set('response', function() {
	return new Response();
});

// Create a router, injecting the dependencies
$router = new Router($container->get('request'), $container->get('response'), '/hello');

echo '<pre>';
var_dump($router);