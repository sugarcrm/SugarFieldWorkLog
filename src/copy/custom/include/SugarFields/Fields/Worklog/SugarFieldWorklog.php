<?php

require_once 'include/SugarFields/Fields/Text/SugarFieldText.php';
require_once 'custom/include/SugarFields/Fields/Worklog/SugarFieldWorklogHelpers.php';

class SugarFieldWorklog extends SugarFieldText
{
    /**
     * Formats a field for the Sugar API
     * @param array $data
     * @param SugarBean $bean
     * @param array $args
     * @param string $fieldName
     * @param array $properties
     * @param array|null $fieldList
     * @param ServiceBase|null $service
     */
    public function apiFormatField(
        array &$data,
        SugarBean $bean,
        array $args,
        $fieldName,
        $properties,
        array $fieldList = null,
        ServiceBase $service = null
    )
    {
        global $current_user;
        $value = SugarFieldWorklogHelpers::decodeJsonValue($bean->$fieldName, $current_user, true);
        $data[$fieldName . "_history"] = $value;
        $data[$fieldName] = '';
    }

    /**
     * Extends apiSave to add handleWorklogSave
     * @param SugarBean $bean
     * @param array $params
     * @param string $field
     * @param array $properties
     */
    public function apiSave(SugarBean $bean, array $params, $field, $properties)
    {
        parent::apiSave($bean, $params, $field, $properties);
        SugarFieldWorklogHelpers::addLogEntry($bean, $field, $bean->$field);
    }

    /**
     * Extends save to add handleWorklogSave
     * @param $bean
     * @param $params
     * @param string $field
     * @param array $properties
     * @param string $prefix
     */
    public function save($bean, $params, $field, $properties, $prefix = '')
    {
        parent::save($bean, $params, $field, $properties, $prefix);
        SugarFieldWorklogHelpers::addLogEntry($bean, $field, $bean->$field);
    }
}

?>
