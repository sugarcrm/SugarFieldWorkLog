SugarCRM Custom Field - Worklog (v1.0)
================================
By Jon Whitcraft - Engineer at SugarCRM

How To Use:
---------------------------------
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
SugarFieldWorklog by Jon Whitcraft is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. http://creativecommons.org/licenses/by-sa/3.0/