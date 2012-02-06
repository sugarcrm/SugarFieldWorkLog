<?php
/*

Modification information for LGPL compliance
*/
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {sugar_load_related} function plugin
 *
 * Type:     function<br>
 * Name:     sugar_load_worklog<br>
 * Purpose:  Load related beans by listing the specified module and relationship to load
 *
 * @author Jon Whitcraft <jwhitcraft at sugarcrm.com>
 * @param array
 * @param Smarty
 */

function smarty_function_sugar_load_worklog($params, &$smarty)
{
    global $beanList;

    if (!isset($params['var']) ||
        !isset($params['module'])
    ) {
        $smarty->trigger_error("sugar_load_related: missing required parameter");
        return;
    }

    $bean = BeanFactory::getBean(trim($params['module']));

    if (!empty($params['id'])) {
        $bean->retrieve($params['id']);
    }

    $field_def = $bean->getFieldDefinition('notes');

    if ($field_def['type'] !== 'link') {
        // it's not a link field so return an empty array
        $smarty->assign($params['var'], array());
    } else {

        $rel = $field_def['name'];
        $bean->load_relationship($rel);
        $relBeanClass = BeanFactory::getBean($bean->$rel->getRelatedModuleName());

        $relBeans = $bean->$rel->getBeans($relBeanClass);

        $outputRelated = array();
        foreach ($relBeans as $relBean) {
            if ($relBean->display_in_worklog_c == 1) {
                $outputRelated[strtotime($relBean->date_entered)] = array(
                    'name' => $relBean->created_by_name,
                    'note' => $relBean->description,
                    'created' => preg_replace("#\s#", " at ", $relBean->date_entered),
                    'updated' => preg_replace("#\s#", " at ", $relBean->date_modified),
                    'updated_by' => $relBean->modified_by_name,
                    'is_updated' => ($relBean->date_entered != $relBean->date_modified)
                );
            }
        }

        ksort($outputRelated);

        $smarty->assign($params['var'], $outputRelated);
    }
}
