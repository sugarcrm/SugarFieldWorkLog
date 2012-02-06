<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jwhitcraft
 * Date: 2/5/12
 * Time: 4:03 PM
 * To change this template use File | Settings | File Templates.
 */

function smarty_function_sugarvar_regex($params, &$smarty)
{
    $contents = smarty_function_sugarvar($params, $smarty);

    $contents = substr($contents, 0, strlen($contents)-1);

    if(isset($params['search']) || isset($params['replace'])) {
        $contents .= '|regex_replace:"' . $params['search'] .'":\'' . $params['replace'] .'\'';
    }

    $contents .= '}';

    return $contents;
}
