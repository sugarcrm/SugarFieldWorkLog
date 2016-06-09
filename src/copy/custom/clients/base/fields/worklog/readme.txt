Once installed, you will need to implement a custom vardef extension in ./custom/Extension/modules/<module>/Ext/Vardefs/<filename>.php that contains:

<?php
    //<singular module name> is the singular name of your module. The example being to use "Account" not "Accounts".
    //<field name> is the name of the text field to place the worklog UI over.
    $dictionary[<singular module name>]['fields'][<field name>]['type']='worklog';
    $dictionary[<singular module name>]['fields'][<field name>]['dbType']='text';

    //for elastic search
    $dictionary[<singular module name>]['fields'][<field name>]['full_text_search']['type'] = 'text';
    $dictionary[<singular module name>]['fields'][<field name>]['full_text_search']['boost'] = '3';
    $dictionary[<singular module name>]['fields'][<field name>]['full_text_search']['enabled'] = true;
?>


- This field does not currently support being sent in a stock email template.
- If you need to decode the history json, you can do:

<?php
    require_once('custom/include/SugarFields/Fields/Worklog/SugarFieldWorklogHelpers.php');
    //you can pass in a user object as a second parameter to decodeJsonValue to convert the timestamps to a specific users timezone
    $displayValue = SugarFieldWorklogHelpers::decodeJsonValue($bean-><field name>));
?>