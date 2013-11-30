<?php


if (!defined ('_PROJECT_PATH_')) exit ('"_PROJECT_PATH_" is not defined yet!');

defined ('DS') || define ('DS', '/');
defined ('_ROSE_PATH_') || define('_ROSE_PATH_', dirname(__FILE__) . DS);

require_once _ROSE_PATH_ . 'func' . DS . 'RoseHelper.func.php';

require_cache (_ROSE_PATH_ . 'core' . DS . 'RoseImporter.php');

spl_autoload_register('RoseImporter::autoload');
