<?php

RoseImporter::import ('core::RoseBaseApp');

class RoseWebApp extends RoseBaseApp 
{
	public $request;
	public $response;
	
	public function process (RoseHTTPRequest $request) 
	{
		$this->request = $request;
		$this->request->app = $this;

		$this->pipeline->process ($request);
		$this->response->render ();
	}	

	protected function generateAppID ()
	{
		$ip = isset ($_SERVER ['REMOTE_ADDR']) ? 
			$_SERVER ['REMOTE_ADDR'] : '127.0.0.1';
        $time = gettimeofday();
        $time = $time['sec'] * 100 + $time['usec'];
        $ip = ip2long($ip);
        $id = ($time ^ $ip) & 0xFFFFFFFF;

        return floor($id / 100) * 100;
	}

	protected function errorHandler ()
	{

	}

	protected function exceptionHandler ()
	{
		Logger::error ($info);
		$response->header (500);
		$reponse->render;
	}
}
