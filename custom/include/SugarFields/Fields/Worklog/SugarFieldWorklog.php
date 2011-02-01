<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jwhitcraft
 * Date: 1/31/11
 * Time: 9:59 PM
 * To change this template use File | Settings | File Templates.
 */

require_once('include/SugarFields/Fields/Text/SugarFieldText.php');

class SugarFieldWorklog extends SugarFieldText
{

    function getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex)
    {
        //This only runs when the cached TPL file is created
        $this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
        return $this->fetch('custom/include/SugarFields/Fields/Worklog/EditView.tpl');
    }

    public function save(&$bean, $params, $field, $properties, $prefix = '')
    {
        global $current_user, $timedate, $sugar_config;

        $d = $sugar_config['default_date_format'];
        $t = $sugar_config['default_time_format'];
        $log_date = date("$d \a\\t $t", time());

        if (!empty($bean->$field)) {
            $msg = PHP_EOL . PHP_EOL;
        }
        $msg .= "<b>" . $current_user->name . " on " . $log_date . "</b>" . PHP_EOL . $params[$field . '_worklog'];

        $bean->$field = $msg;
    }
}