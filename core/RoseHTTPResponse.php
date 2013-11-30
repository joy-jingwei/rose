<?php

RoseImporter::import ('core::RoseWebApp');

class RoseHTTPResponse
{
	// only defined common used status code
	const HTTP_STATUS_CODE_OK = 200;
	const HTTP_STATUS_CODE_NOT_FOUND = 404;
	const HTTP_STATUS_CODE_REDIRECT_ONCE = 302;
	const HTTP_STATUS_CODE_REDIRECT_PERMANENT = 301;
	const HTTP_STATUS_CODE_SERVER_ERROR = 500;
	
	const HTTP_CONTENT_TYPE_HTML = 'text/html';
    const HTTP_CONTENT_TYPE_PLAIN = 'text/plain';
    const HTTP_CONTENT_TYPE_JSON = 'application/json';
    const HTTP_CONTENT_TYPE_XML = 'application/xml';

	public $app;

	public $statusCode = self::HTTP_STATUS_CODE_OK;
	public $contentType;
	public $redirectURL;
	public $headers;
	public $cookies;
	public $body;
	public $encoding = 'UTF-8';

	private $_debug = FALSE;

	public function __construct (RoseWebApp $app)
	{
		$this->app = $app;
		$this->init ();
	}

	protected function init () 
	{
		$this->app->debug ? $this->debugON () : $this->debugOFF ();
	}

	public function render () {}

	public function output ()
	{
		$this->outputHeader ();
		$this->outputBody ();

		return $this;
	}
	
    function setCookie($key, $value, $path = '/', $domain = NULL, $secure = FALSE, $httponly = FALSE, $expires = NULL)
    {
        $this->cookies[] = array($key, $value, $expires, $path, $domain, $secure, $httponly);
        return $this;
    }

    function deleteCookie($key, $value = '', $path = '/', $domain = NULL, $secure = FALSE, $httponly = FALSE, $expires = 1)
    {
        $this->cookies[] = array($key, $value, $expires, $path, $domain, $secure, $httponly);
        return $this;
    }

    function redirect ($url, $isOnce = true) 
    {
        $this->statusCode = $isOnce ? self::HTTP_STATUS_CODE_REDIRECT_ONCE : self::HTTP_STATUS_CODE_REDIRECT_PERMANENT;
        $this->redirectURL = $url;

        return $this;
    }

	public final function debugON ()
	{
		$this->_debug = TRUE;
		$this->startDebug ();

		return $this;
	}

	public final function debugOFF ()
	{
		$this->_debug = FALSE;
		$this->stopDebug ();

		return $this;
	}

	public final function isDebugON ()
	{
		return $this->_debug;
	}

	protected function startDebug () {}

	protected function stopDebug () {}

	protected function outputHeader ()
	{
		// output http status code
        switch ($this->statusCode) 
        {
            case self::HTTP_STATUS_CODE_OK:
                // set no cache
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
                header ('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
                header ('Pragma: no-cache');
                break;
            case self::HTTP_STATUS_CODE_NOT_FOUND :
                header("HTTP/1.1 404 Not Found");
                break;
            case self::HTTP_STATUS_CODE_REDIRECT_ONCE :
                header('Location: ' . $this->redirectURL);
                break;
            case self::HTTP_STATUS_CODE_REDIRECT_PERMANENT:
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: ' . $this->redirectURL);
                break;
            case self::HTTP_STATUS_CODE_SERVER_ERROR:
                header('HTTP/1.1 500 Internal Server Error');
                break;
            default :
                trigger_error("unsupported http status code '{$this->statusCode}", E_USER_ERROR);
        }

        // output content type
        header ('Content-Type: ' . $this->contentType . '; charset=' . $this->encoding);

        // output customized headers
        foreach ($this->headers as $header) 
        {
            header ($header);
        }

        // set cookies
        foreach ($this->cookies as $cookie) 
		{
            call_user_func_array('setcookie', $cookie);
        }

        return $this;
	}

	protected function outputBody ()
	{
		echo $this->body;
	}
}
