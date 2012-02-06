<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jwhitcraft
 * Date: 1/31/11
 * Time: 9:59 PM
 * To change this template use File | Settings | File Templates.
 */

require_once('include/SugarFields/Fields/Text/SugarFieldText.php');

class SugarFieldNotesworklog extends SugarFieldText
{

    public function save(&$bean, $params, $field, $properties, $prefix = '')
    {
        global $current_user, $sugar_config;

        $note = BeanFactory::getBean('Notes');
        $note->assigned_user_id = $current_user->id;
        $note->created_by = $current_user->id;
        $note->name = "Worklog Entry By " . $current_user->name;
        $note->description = trim($params[$field . '_worklog']);
        $note->parent_id = $bean->id;
        $note->parent_thpe = $bean->module_dir;
        $note->display_in_worklog_c = true;

        $note->save(false);
    }
}
