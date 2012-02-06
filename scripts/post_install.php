<?php
function post_install()
{
    require_once('modules/ModuleBuilder/parsers/ParserFactory.php');


    $parser = ParserFactory::getParser('editview', 'Notes');
    $parser->addField(array(
        'name' => 'display_in_worklog_c',
        'label' => 'LBL_DISPLAY_IN_WORKLOG'
    ));
    $parser->handleSave(false);

    unset($parser);

}
