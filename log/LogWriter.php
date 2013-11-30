<?php

class LogWriter 
{
	private $_path;
	private $_file;	
	private $_roll;	
	private $_bufferLength = 4096;
	private $_buffered = '';
	
	public function constructor ($path, $file, $roll, $bufferLength)
	{
		
	}
	
	public function append ($info)
	{
		$this->_buffered .= $info;
		if ($this->_bufferLength > 0 && strlen($this->_buffered) > $this->_bufferLength) 
		{
			$this->flush ();
		}
		
		return $this;
	}
	
	public function appendLine ($info = "")
	{
		return $this->append ($info . "\n");
	}
	
	public function flush ()
	{
		$this->_buffered = '';
	}	
}
