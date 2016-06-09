<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$output = true;
if (php_sapi_name() === 'cli') {
     $output = false;
}

require_once('modules/Administration/QuickRepairAndRebuild.php');
$RAC = new RepairAndClear();
$actions = array('clearAll');
$RAC->repairAndClearAll($actions, array('All Modules'), false, $output);
