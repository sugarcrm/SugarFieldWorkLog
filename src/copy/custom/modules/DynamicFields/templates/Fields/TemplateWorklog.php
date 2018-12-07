<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once 'modules/DynamicFields/templates/Fields/TemplateText.php';

class TemplateWorklog extends TemplateText
{
    var $type = 'text';
    var $len = '';

    public function __construct()
    {
        $this->vardef_map['rows'] = 'ext2';
        $this->vardef_map['cols'] = 'ext3';
    }

    function set($values)
    {
        parent::set($values);
        if (!empty($this->ext2)) {
            $this->rows = $this->ext2;
        }
        if (!empty($this->ext3)) {
            $this->cols = $this->ext3;
        }
        if (!empty($this->ext4)) {
            $this->default_value = $this->ext4;
        }
    }


    function get_xtpl_detail()
    {
        $name = $this->name;
        return nl2br($this->bean->$name);
    }

    function get_field_def()
    {
        $def = parent::get_field_def();
        $def['studio'] = 'visible';

        if (isset ($this->ext2) && isset ($this->ext3)) {
            $def['rows'] = $this->ext2;
            $def['cols'] = $this->ext3;
        }
        if (isset($this->rows) && isset ($this->cols)) {
            $def['rows'] = $this->rows;
            $def['cols'] = $this->cols;
        }

        //handle db type
        $def['dbType'] = 'text';

        //handle fts search
        $def['full_text_search']['type'] = 'text';

        return $def;
    }

    function get_db_default($modify=false)
    {
        // TEXT columns in MySQL cannot have a DEFAULT value - let the Bean handle it on save
        return null; // Bug 16612 - null so that the get_db_default() routine in TemplateField doesn't try to set DEFAULT
    }

}
