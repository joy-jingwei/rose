<?php

RoseImporter::import ('core::RosePipelineInterface');

class RoseBaseApp 
{
	public $appID;

	public $timer;
	public $logger;	

	public $debug;
	public $runMode;
	
	protected $pipeline;	
	protected $exceptionHandler;
	protected $errorHandler;
	
	public function __construct ($components, RosePipelineInterface $pipeline)
	{
		$this->pipeline = $pipeline;
		$this->pipeline->app = $this;
		$this->appID = $this->generateAppID ();
	}
	
	public function init () {}
	
	protected function generateAppID ()
	{
		
	}
	
	public function registerErrorHandler ($handler, $errorLevel = NULL)
	{
		
	}
	
	public function registerExceptionHandler ($handler, $exceptionLevel = NULL)
	{
		
	}
}
