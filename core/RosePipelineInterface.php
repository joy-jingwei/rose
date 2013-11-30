<?php

RoseImporter::import ('core::RoseHTTPRequest');

interface RosePipelineInterface
{
	public function process (RoseHTTPRequest $request);
}