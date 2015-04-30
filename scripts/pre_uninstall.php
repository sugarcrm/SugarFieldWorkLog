<?php
function pre_uninstall()
{
	require_once('modules/ModuleBuilder/Module/StudioModule.php');

    $sm = new StudioModule("Notes");
    $sm->removeFieldFromLayouts('display_in_worklog_c');

	echo "<br><strong>Worklog Field for SugarCRM has been successfully uninstalled</strong>";
}
