<?php

RoseImporter::import ('dispatcher::RoseURIParserChain');

class RoseRequestDispatcher
{
	private $_request;
	private $_parsers;

	private $_controllerFileFullName;
	private $_controllerClassName;
	private $_actionName;

	private $_isParsed = FALSE;

	public function __construct (RoseHTTPRequest $request, RoseURIParserChain $parsers)
	{
		$this->_request = $request;
		$this->_parsers = $parsers;
	}

	public function getControllerFileFullName ()
	{
		$this->_isParsed || $this->_parse ();

		return $this->_controllerFileFullName;
	}

	public function getControllerClassName ()
	{
		$this->_isParsed || $this->_parse ();

		return $this->_controllerClassName;
	}

	public function getActionName ()
	{
		$this->_isParsed || $this->_parse ();

		return $this->_actionName;
	}

	private function _parse ()
	{
		

		$this->_isParsed = TRUE;
	}
}