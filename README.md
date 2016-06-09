WorklogField
============

This is a module loadable field type for use with Sugar 7. The key features of this field type is that worklog entries will be adjusted by the current users display preferences for user names, timezones, and date formats.
This field was created as a replacement for the original worklog field by Jon Whitcraft ( http://h2ik.co/2012/02/sugarfield-worklog-v1-0-released/ ) as it is not currently being adapted from 6.x.
# Usage
This repo is the source for a module loadable package that can be installed to Sugar through the module loader. Once installed, Administrators can navigate to Admin / Studio / {module>} / Fields and create a new database field with the type of 'Worklog'.

* If you are a developer and would like to convert an existing field to a worklog type field, you will need to implement a custom vardef extension in ./custom/Extension/modules/{module}/Ext/Vardefs/{filename}.php that contains the code below. It is very important to convert the fields db column to a type that can support large blocks of text such as longtext or you may run into truncation issues.

```php
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
```

* To implement report filtering, you will need to make a core file change in modules/Reports/templates/templates_modules_def_js.php at line 486 by adding  `filter_defs['worklog'] = qualifiers;`.
* This field is not supported in workflow.
* This field does not currently support being sent in a stock email template.
* If you need to decode the history json for a customization, you can do:

```php
<?php
    require_once('custom/include/SugarFields/Fields/Worklog/SugarFieldWorklogHelpers.php');
    //you can pass in a user object as a second parameter to decodeJsonValue to convert the timestamps to a specific users timezone
    $displayValue = SugarFieldWorklogHelpers::decodeJsonValue($bean-><field name>));
?>
```

To Do
============
- Implement mobile layouts

#Building Installer Package
To build the installer package, you will need to download the contents on this repository and execute:
```
php build.php
```
Once completed, the installer .zip package will be located under `./builds/`.
    
#Contributing
Everyone is welcome to be involved by creating or improving functionality. If you would like to contribute, please make sure to review the [CONTRIBUTOR TERMS](CONTRIBUTOR TERMS.pdf). When you update this [README](README.md), please check out the [contribution guidelines](CONTRIBUTING.md) for helpful hints and tips that will make it easier to accept your pull request.

## Contributors
[Jerry Clark](https://github.com/geraldclark)

[Jon Whitcraft](https://github.com/jwhitcraft)

# Licensed under Apache
© 2016 SugarCRM Inc.  Licensed by SugarCRM under the Apache 2.0 license.
