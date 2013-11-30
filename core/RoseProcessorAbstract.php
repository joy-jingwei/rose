<?php

RoseImporter::import ('core::RoseWebApp');

abstract class RoseProcessorAbstract
{
	protected $app;
	protected $timer;
	
	public function __construct (RoseWebApp $app)
	{
		$this->app = $app;		
	}
	
	public final function process ()
	{
		/*
		$this->timer = $app->timer->spawn ($this->getTimerName());
		$this->timer->start ();
		
		if (!$this->isNeedProcess()) return TRUE;
		*/
		$result = $this->execute();
		
		//$this->timer->stop ();
		
		return $result;
	}
	
	protected function isNeedProcess ()
	{
		return TRUE;
	}
	
	protected function getTimerName ()
	{
		return get_class ();
	}

	protected abstract function execute ();
}
