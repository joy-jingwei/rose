<?php

define ('_PROJECT_PATH_', dirname(__FILE__));
define ('_ROSE_PATH_', dirname(dirname(dirname($path))));

require_once _ROSE_PATH_ . 'preload.inc.php';

$request = new MothershipRequest ();
$app = new MothershipApp ($requst, $response);


$app->loadProcessors (array(
	'URLFormatProcessor',
	'URLRewriteProcessor',
	'URLParseProcessor',
	'ActionProcessor',
	)
);
$app->process ($request);