<?php

// NOTE: You must have FirePHP Companion installed (http://www.christophdorn.com/Tools/)

// See FirePHP Companion or Firebug Console for result (depending on $_GET['target'])

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');

$console = FirePHP::to('page')->console('Problems');
if(isset($_GET['target'])) {    // set by the drop-down in the reference
    $console = FirePHP::to($_GET['target'])->console('Problems');
    if($_GET['target']=='request') {
        FirePHP::to('controller')->triggerInspect();
    }
}


$engine = FirePHP::plugin('engine');
$engine->onException($console);

try {
    throw new Exception('First Test Exception');
} catch(Exception $e) {
    $engine->handleException($e);
}

try {
    throw new Exception('Second Test Exception');
} catch(Exception $e) {
    FirePHP::plugin('engine')->handleException($e);
}
