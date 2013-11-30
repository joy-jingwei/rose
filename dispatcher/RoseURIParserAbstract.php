<?php

RoseImporter::import ('core::RoseHTTPRequest');

abstract class RoseURIParserAbstract
{
	protected $request;

	private $_projectName;
	private $_moduleName;
	private $_submoduleName;
	private $_controllerName;
	private $_actionName;

	public function __construct (RoseHTTPRequest $request)
	{
		$this->request = $request;
	}

	public function getProjectName ($default = NULL)
	{
		return $this->_projectName ? $default : $this->_projectName;
	}

	public function getModuleName ($default = NULL)
	{
		return $this->_moduleName ? $default : $this->_moduleName;
	}

	public function getSubmoduleName ($default = NULL)
	{
		return $this->_submoduleName ? $default : $this->_submoduleName;
	}

	public function getControllerName ($default = NULL)
	{
		return $this->_controllerName ? $default : $this->_controllerName;
	}

	public function getActionName ($default = NULL)
	{
		return $this->_actionName ? $default : $this->_actionName;
	}

	public abstract function tryParse ($uri);
}