<?php

// NOTE: You must have FirePHP Companion installed (http://www.christophdorn.com/Tools/)

// See FirePHP Companion or Firebug Console for result (depending on $_GET['target'])

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');

$console = FirePHP::to('page')->console();
if(isset($_GET['target'])) {    // set by the drop-down in the reference
    $console = FirePHP::to($_GET['target'])->console();
    if($_GET['target']=='request') {
        FirePHP::to('controller')->triggerInspect();
    }
}


$header = array('Column 1 Heading', 'Column 2 Heading');
$table = array(
    array('Row 1 Column 1 Value', 'Row 1 Column 2 Value'),
    array(10, true)
);
$console->table('Table without header', $table);
$console->table('Table with header', $table, $header);
