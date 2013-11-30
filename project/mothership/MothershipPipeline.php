<?php

RoseImporter::import ('core::RosePipelineInterface');
RoseImporter::import ('core::RoseURLRewriteProcessor');
RoseImporter::import ('core::RoseHTTPResponse');
RoseImporter::import ('processor::RoseActionInvokeProcessor');

class MothershipPipeline implements RosePipelineInterface
{
	private $_app;

	public function process (RoseHTTPRequest $request)
	{
		$this->_app = $request->app;

		require_cache (_PROJECT_PATH_ . 'MothershipResponsePage.php');
		$processor = new RoseActionInvokeProcessor ($this->_app);
		$processor->process ();
	}

	private function _registerProcessors ()
	{

	}
}