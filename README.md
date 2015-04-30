SugarCRM 6.x Custom Field - Worklog (v1.0)
================================
By Jon Whitcraft - Engineer at SugarCRM

Support For SugarCRM 7.x
================================
[Check here for a version of the Worklog field support 7.x](https://github.com/geraldclark/WorklogField)


How To Use:
---------------------------------
1 Download the add-on from https://github.com/downloads/sugarcrm/SugarFieldWorkLog/SugarFieldWorklog-v1.1.1.zip

2 Install the zip file via the Module Loader in the Admin Section

3 Add the custom code found below.

If you are adding a new field add a textarea field and then add the following lines to a file in custom/Extension/modules/<module name>/Ext/Vardefs/<some creative name>.php


```php
<?php

// new way that will store the data as a note attached to the record
// this is the recommended way to do this
$dictionary['Bug']['fields']['work_log']['type'] = 'notesworklog';
$dictionary['Bug']['fields']['work_log']['dbType'] = 'text';

// legacy way that will store the data in the field on the recored
$dictionary['Bug']['fields']['work_log']['type'] = 'worklog';
$dictionary['Bug']['fields']['work_log']['dbType'] = 'text';
```
You can also convert a current textarea field to a worklog field by adding the above code to a file.

ToDos
---------------------------------
* Attachment Support in Display
* Display in Portal checkbox if portal is enabled on instance.
* Inline Editing

License
---------------------------------
Apache 2.0 - 2011-2014 © SugarCRM Inc.
