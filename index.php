<?php

define ('_PROJECT_PATH_', dirname(__FILE__) . '/project/mothership/');
define ('_ROSE_PATH_', dirname(__FILE__) . '/');

require_once _ROSE_PATH_ . 'preload.inc.php';
require_cache (_PROJECT_PATH_ . 'MothershipRequest.php');
require_cache (_PROJECT_PATH_ . 'MothershipApp.php');
require_cache (_PROJECT_PATH_ . 'MothershipPipeline.php');

$pipeline = new MothershipPipeline ();
$app = new MothershipApp (array (), $pipeline);
$request = new MothershipRequest ();
$app->debug = $request->isFromDeveloper () && $request->isDebugOn ();

$response = $app->process ($request);
