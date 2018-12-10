<?php

$manifest = array (
    'acceptable_sugar_versions' => array(
        'regex_matches' => array(
            '^7.5\\..+',
            '^7.6\\..+',
            '^7.7\\..+',
            '^7.8\\..+',
            '^7.9\\..+',
            '^8.0\\..+',
            '^8.1\\..+',
            '^8.2\\..+',
            '^8.3\\..+',
        )
    ),
    'acceptable_sugar_flavors' => array(
        0 => 'PRO',
        1 => 'CORP',
        2 => 'ENT',
        3 => 'ULT'
    ),
  'readme' => '',
  'key' => 1410796385,
  'author' => 'SugarCRM Developer Support',
  'description' => 'Work log field for Sugar',
  'icon' => '',
  'is_uninstallable' => true,
  'name' => 'SugarField Work Log Field',
  'published_date' => '2018-11-30 00:00:00',
  'type' => 'module',
  'version' => '2.6.3',
  'remove_tables' => '',
);

$installdefs = array (
  'id' => 1410796385,
  'copy' =>
  array (
    0 =>
    array (
      'from' => '<basepath>/copy/custom/Extension/application/Ext/Language/en_us.worklog.php',
      'to' => 'custom/Extension/application/Ext/Language/en_us.worklog.php',
    ),
    1 =>
    array (
      'from' => '<basepath>/copy/custom/Extension/modules/DynamicFields/Ext/Language/en_us.worklog.php',
      'to' => 'custom/Extension/modules/DynamicFields/Ext/Language/en_us.worklog.php',
    ),
    2 =>
    array (
      'from' => '<basepath>/copy/custom/Extension/modules/ModuleBuilder/Ext/Language/en_us.worklog.php',
      'to' => 'custom/Extension/modules/ModuleBuilder/Ext/Language/en_us.worklog.php',
    ),
    3 =>
    array (
      'from' => '<basepath>/copy/custom/clients/base/fields/worklog/detail.hbs',
      'to' => 'custom/clients/base/fields/worklog/detail.hbs',
    ),
    4 =>
    array (
      'from' => '<basepath>/copy/custom/clients/base/fields/worklog/disabled.hbs',
      'to' => 'custom/clients/base/fields/worklog/disabled.hbs',
    ),
    5 =>
    array (
      'from' => '<basepath>/copy/custom/clients/base/fields/worklog/edit.hbs',
      'to' => 'custom/clients/base/fields/worklog/edit.hbs',
    ),
    6 =>
    array (
      'from' => '<basepath>/copy/custom/clients/base/fields/worklog/list.hbs',
      'to' => 'custom/clients/base/fields/worklog/list.hbs',
    ),
    7 =>
    array (
      'from' => '<basepath>/copy/custom/clients/base/fields/worklog/readme.txt',
      'to' => 'custom/clients/base/fields/worklog/readme.txt',
    ),
    8 =>
    array (
      'from' => '<basepath>/copy/custom/clients/base/fields/worklog/worklog.js',
      'to' => 'custom/clients/base/fields/worklog/worklog.js',
    ),
    9 =>
    array (
      'from' => '<basepath>/copy/custom/clients/base/filters/operators/worklog.php',
      'to' => 'custom/clients/base/filters/operators/worklog.php',
    ),
    10 =>
    array (
      'from' => '<basepath>/copy/custom/include/SugarFields/Fields/Worklog/ClassicEditView.tpl',
      'to' => 'custom/include/SugarFields/Fields/Worklog/ClassicEditView.tpl',
    ),
    11 =>
    array (
      'from' => '<basepath>/copy/custom/include/SugarFields/Fields/Worklog/DetailView.tpl',
      'to' => 'custom/include/SugarFields/Fields/Worklog/DetailView.tpl',
    ),
    12 =>
    array (
      'from' => '<basepath>/copy/custom/include/SugarFields/Fields/Worklog/EditView.tpl',
      'to' => 'custom/include/SugarFields/Fields/Worklog/EditView.tpl',
    ),
    13 =>
    array (
      'from' => '<basepath>/copy/custom/include/SugarFields/Fields/Worklog/SugarFieldWorklog.php',
      'to' => 'custom/include/SugarFields/Fields/Worklog/SugarFieldWorklog.php',
    ),
    14 =>
    array (
      'from' => '<basepath>/copy/custom/include/SugarFields/Fields/Worklog/SugarFieldWorklogHelpers.php',
      'to' => 'custom/include/SugarFields/Fields/Worklog/SugarFieldWorklogHelpers.php',
    ),
    15 =>
    array (
      'from' => '<basepath>/copy/custom/include/SugarFields/Fields/Worklog/WirelessDetailView.tpl',
      'to' => 'custom/include/SugarFields/Fields/Worklog/WirelessDetailView.tpl',
    ),
    16 =>
    array (
      'from' => '<basepath>/copy/custom/include/SugarFields/Fields/Worklog/WirelessEditView.tpl',
      'to' => 'custom/include/SugarFields/Fields/Worklog/WirelessEditView.tpl',
    ),
    17 =>
    array (
      'from' => '<basepath>/copy/custom/include/generic/SugarWidgets/SugarWidgetFieldWorklog.php',
      'to' => 'custom/include/generic/SugarWidgets/SugarWidgetFieldworklog.php',
    ),
    18 =>
    array (
      'from' => '<basepath>/copy/custom/modules/DynamicFields/templates/Fields/Forms/worklog.php',
      'to' => 'custom/modules/DynamicFields/templates/Fields/Forms/worklog.php',
    ),
    19 =>
    array (
      'from' => '<basepath>/copy/custom/modules/DynamicFields/templates/Fields/Forms/worklog.tpl',
      'to' => 'custom/modules/DynamicFields/templates/Fields/Forms/worklog.tpl',
    ),
    20 =>
    array (
      'from' => '<basepath>/copy/custom/modules/DynamicFields/templates/Fields/TemplateWorklog.php',
      'to' => 'custom/modules/DynamicFields/templates/Fields/TemplateWorklog.php',
    ),
    21 =>
    array (
      'from' => '<basepath>/copy/custom/vendor/Smarty/plugins/function.convert_worklog.php',
      'to' => 'custom/vendor/Smarty/plugins/function.convert_worklog.php',
    ),
    22 =>
    array (
      'from' => '<basepath>/copy/custom/include/SugarFields/Fields/Worklog/ListView.tpl',
      'to' => 'custom/include/SugarFields/Fields/Worklog/ListView.tpl',
    ),
    23 =>
    array (
      'from' => '<basepath>/copy/custom/Extension/application/Ext/Console/RegisterWorklogCommands.php',
      'to' => 'custom/Extension/application/Ext/Console/RegisterWorklogCommands.php',
    ),
    24 =>
    array (
      'from' => '<basepath>/copy/custom/src/Worklog/Console/Command/Migrate.php',
      'to' => 'custom/src/Worklog/Console/Command/Migrate.php',
    ),
  ),
  'post_execute' =>
  array (
    0 => '<basepath>/post_execute/0.php',
  ),
  'post_uninstall' =>
  array (
    0 => '<basepath>/post_uninstall/0.php',
  ),
);

?>
