<?php

RoseImporter::import ('core::RoseWebApp');

class RoseHTTPRequest
{

	/**
	 * `NULL` means unknown
	 */

	public $app;
	
	// unsensitive `GET` or `POST`
	//protected $get;
	//protected $post;
	protected $inputs;
	protected $puts;

	protected $uri;
	protected $url;
	protected $host;
	protected $requestMethod;
	protected $cookies;
	protected $files;
	protected $headers;
	protected $clientIP;
	protected $referer;
	protected $inputFormat;

	// context
	protected $server;
	protected $env;
	protected $session;

	protected $isAJAX;

	// attached information that is application relevant
	protected $moduleName;
	protected $submoduleName;
	protected $controllerName;
	protected $actionName;

	public function __construct ()
	{
		$this->init ();
	}
	
	////////////////////////////////////////////////
	////////////////  helpers //////////////////////
	////////////////////////////////////////////////

	public function getInput ($name, $default = NULL)
	{

	}
	
	public function getCookie ($name, $default = NULL)
	{
		
	}
	
	public function getFile ($name, $default = NULL)
	{
		
	}
	
	public function getHeader ($name, $default = NULL)
	{
		
	}

	
	////////////////////////////////////////////////
	////////  internal self initialization  ////////
	////////////////////////////////////////////////

	protected function init ()
	{
		dump ($_SERVER);
		dump ($_ENV);

		// init inputs
		$this->inputs = $_REQUEST;
		$this->puts = file_get_contents('php://input');
		$this->files = $_FILES;

		$this->uri = '/' . ltrim($_SERVER['REQUEST_URI'], '/');
		$query = http_build_query($_GET);
		$this->url = $this->uri . ($query ? "?$query" : "");
		$this->host = $this->getHost ();

		$this->requestMethod = $_SERVER ['REQUEST_METHOD'];

		// init cookies
		if (get_magic_quotes_gpc()) 
		{
            $_COOKIE = array_map('stripslashes', $_COOKIE);
        }
		$this->cookies = $_COOKIE;

		$this->clientIP = $this->getClientIP ();

		if (isset ($_SERVER ['HTTP_REFERER'])) 
			$this->referer = isset ($_SERVER ['HTTP_REFERER']);

		$this->env = $_ENV;
	}

	protected function getClientIP ()
	{
		if (!empty($_SERVER['X-Real-IP'])) return $_SERVER['X-Real-IP'];
        if (!empty($_SERVER['REMOTE_ADDR'])) return $_SERVER['REMOTE_ADDR'];
        return NULL;
	}

	protected function getHost ()
	{
		return isset ($_SERVER ['HTTP_HOST']) ? strtolower($_SERVER ['HTTP_HOST']) : NULL;
	}

	protected function isAJAX ()
	{
		//@todo finish me
	}
}