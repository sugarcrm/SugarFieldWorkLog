<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jwhitcraft
 * Date: 1/31/11
 * Time: 9:59 PM
 * To change this template use File | Settings | File Templates.
 */
 
require_once('include/SugarFields/Fields/Base/SugarFieldBase.php');
require_once('custom/include/SugarFields/Fields/Maskedinput/SugarFieldMaskedinputjs.php');

class SugarFieldWorklog extends SugarFieldText {
    
    function getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex){
    	//This only runs when the cached TPL file is created
        $this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);;
        return $this->fetch('custom/include/SugarFields/Fields/Worklog/EditView.tpl');
    }

	public function save(&$bean, $params, $field, $properties, $prefix = '') {
		//This is run whenever this custom field is being saved from an editview
		//Here you would include any pre-save processing that needs to be done
	}
}