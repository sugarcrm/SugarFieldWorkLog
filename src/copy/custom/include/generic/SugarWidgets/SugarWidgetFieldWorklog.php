<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once 'include/generic/SugarWidgets/SugarWidgetFieldtext.php';

class SugarWidgetFieldWorklog extends SugarWidgetFieldText
{
    function SugarWidgetFieldWorklog(&$layout_manager)
    {
        parent::SugarWidgetFieldText($layout_manager);
    }

    function queryFilterEquals($layout_def)
    {
        return $this->reporter->db->convert($this->_get_column_select($layout_def), "text2char") .
            " = " . $this->reporter->db->quoted($layout_def['input_name0']);
    }

    function queryFilterNot_Equals_Str($layout_def)
    {
        $column = $this->_get_column_select($layout_def);
        return "($column IS NULL OR " . $this->reporter->db->convert($column, "text2char") . " != " .
            $this->reporter->db->quoted($layout_def['input_name0']) . ")";
    }

    function queryFilterNot_Empty($layout_def)
    {
        $column = $this->_get_column_select($layout_def);
        return "($column IS NOT NULL AND " . $this->reporter->db->convert($column, "length") . " > 0)";
    }

    function queryFilterEmpty($layout_def)
    {
        $column = $this->_get_column_select($layout_def);
        return "($column IS NULL OR " . $this->reporter->db->convert($column, "length") . " = 0)";
    }

    function displayList($layout_def)
    {
        return SugarFieldWorklogHelpers::decodeJsonValue(htmlspecialchars_decode(parent::displayListPlain($layout_def)), null, true);
    }
}
