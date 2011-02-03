<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Enterprise Subscription
 * Agreement ("License") which can be viewed at
 * http://www.sugarcrm.com/crm/products/sugar-enterprise-eula.html
 * By installing or using this file, You have unconditionally agreed to the
 * terms and conditions of the License, and You may not use this file except in
 * compliance with the License.  Under the terms of the license, You shall not,
 * among other things: 1) sublicense, resell, rent, lease, redistribute, assign
 * or otherwise transfer Your rights to the Software, and 2) use the Software
 * for timesharing or service bureau purposes such as hosting the Software for
 * commercial gain and/or for the benefit of a third party.  Use of the Software
 * may be subject to applicable fees and any use of the Software without first
 * paying applicable fees is strictly prohibited.  You do not have the right to
 * remove SugarCRM copyrights from the source code or user interface.
 *
 * All copies of the Covered Code must include on each user interface screen:
 *  (i) the "Powered by SugarCRM" logo and
 *  (ii) the SugarCRM copyright notice
 * in the same form as they appear in the distribution.  See full license for
 * requirements.
 *
 * Your Warranty, Limitations of liability and Indemnity are expressly stated
 * in the License.  Please refer to the License for the specific language
 * governing these rights and limitations under the License.  Portions created
 * by SugarCRM are Copyright (C) 2004-2011 SugarCRM, Inc.; All Rights Reserved.
 ********************************************************************************/

require_once('modules/DynamicFields/templates/Fields/TemplateTextArea.php');
class TemplateWorklog extends TemplateTextArea
{
    var $type = 'Worklog';

    function __construct()
    {
        $this->vardef_map['rows'] = 'ext2';
        $this->vardef_map['cols'] = 'ext3';
    }

    function get_db_type()
    {
        if ($GLOBALS['db']->dbType == 'oci8') {
            return "CLOB";
        } else if (!empty($GLOBALS['db']->isFreeTDS)) {
            return "NTEXT";
        } else {
            return "TEXT";
        }
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
        $def['type'] = 'worklog';
        $def['dbType'] = $this->get_db_type();

        if (isset ($this->ext2) && isset ($this->ext3)) {
            $def['rows'] = $this->ext2;
            $def['cols'] = $this->ext3;
        }
        if (isset($this->rows) && isset ($this->cols)) {
            $def['rows'] = $this->rows;
            $def['cols'] = $this->cols;
        }
        return $def;
    }

    function get_db_default()
    {
        // TEXT columns in MySQL cannot have a DEFAULT value - let the Bean handle it on save
        return null; // Bug 16612 - null so that the get_db_default() routine in TemplateField doesn't try to set DEFAULT
    }
}

