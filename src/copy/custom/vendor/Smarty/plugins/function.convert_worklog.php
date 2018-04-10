<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/**
 * Smarty plugin to convert the worklog to html
 */

require_once 'custom/include/SugarFields/Fields/Worklog/SugarFieldWorklogHelpers.php';

function smarty_function_convert_worklog($params, &$smarty)
{
    if (empty($params['log'])) {
        $smarty->trigger_error("Worklog: missing 'log' parameter");
    }

    global $current_user;
    return SugarFieldWorklogHelpers::decodeJsonValue(trim(html_entity_decode($params['log'], ENT_QUOTES)), $current_user, true);
}

?>