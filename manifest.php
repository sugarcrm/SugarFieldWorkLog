<?PHP
/*****************************************************************************
 * The contents of this file are subject to the RECIPROCAL PUBLIC LICENSE
 * Version 1.1 ("License"); You may not use this file except in compliance
 * with the License. You may obtain a copy of the License at
 * http://opensource.org/licenses/rpl.php. Software distributed under the
 * License is distributed on an "AS IS" basis, WITHOUT WARRANTY OF ANY KIND,
 * either express or implied.
 *
 * You may:
 * a) Use and distribute this code exactly as you received without payment or
 *    a royalty or other fee.
 * b) Create extensions for this code, provided that you make the extensions
 *    publicly available and document your modifications clearly.
 * c) Charge for a fee for warranty or support or for accepting liability
 *    obligations for your customers.
 *
 * You may NOT:
 * a) Charge for the use of the original code or extensions, including in
 *    electronic distribution models, such as ASP (Application Service
 *    Provider).
 * b) Charge for the original source code or your extensions other than a
 *    nominal fee to cover distribution costs where such distribution
 *    involves PHYSICAL media.
 * c) Modify or delete any pre-existing copyright notices, change notices,
 *    or License text in the Licensed Software
 * d) Assert any patent claims against the Licensor or Contributors, or
 *    which would in any way restrict the ability of any third party to use the
 *    Licensed Software.
 *
 * You must:
 * a) Document any modifications you make to this code including the nature of
 *    the change, the authors of the change, and the date of the change.
 * b) Make the source code for any extensions you deploy available via an
 *    Electronic Distribution Mechanism such as FTP or HTTP download.
 * c) Notify the licensor of the availability of source code to your extensions
 *    and include instructions on how to acquire the source code and updates.
 * d) Grant Licensor a world-wide, non-exclusive, royalty-free license to use,
 *    reproduce, perform, modify, sublicense, and distribute your extensions.
 *
 * The Initial Developer of the Original Code is Kenneth Brill
 * All Rights Reserved.
 ********************************************************************************/
$manifest = array(

    'acceptable_sugar_versions' => array(
        'regex_matches' => array(
            "6\.*",
        ),
    ),
    'acceptable_sugar_flavors' => array(
        'OS',
        'PRO',
        'CORP',
        'ENT',
        'ULT',
        'CE',
    ),
    'readme' => '',
    'name' => 'WorkLog Custom Field',
    'description' => 'A Custom Worklog Field',
    'author' => 'Jon Whitcraft <jwhitcraft at sugarcrm.com>',
    'published_date' => '2/10/2012',
    'version' => '1.1.1',
    'type' => 'module',
    'is_uninstallable' => true,
);

$installdefs = array(
    'id' => '4f78ec2dfef05b22d287f425659c92ac', // md5 of 'jwhitcraft-worklog-field'
    'language' => array(
        array(
            'from' => '<basepath>/languages/Notes/en_us.lang.php',
            'to_module' => 'Notes',
            'language' => 'en_us'
        )
    ),
    'mkdir' => array(
        array('path' => 'custom/include'),
        array('path' => 'custom/include/Smarty'),
        array('path' => 'custom/include/Smarty/plugins'),
        array('path' => 'custom/include/SugarFields'),
        array('path' => 'custom/include/SugarFields/Fields'),
    ),
    'copy' => array(
        array('from' => '<basepath>/custom/include/',
            'to' => 'custom/include',
        ),
        array('from'=> '<basepath>/include/generic/SugarWidgets/SugarWidgetFieldworklog.php',
            'to'=> 'include/generic/SugarWidgets/SugarWidgetFieldworklog.php',
        ),
    ),
    'custom_fields' => array(
        'Notesdisplay_in_worklog_c' => array(
            'comments' => NULL,
            'help' => NULL,
            'module' => 'Notes',
            'type' => 'bool',
            'max_size' => '255',
            'require_option' => '0',
            'default_value' => NULL,
            'deleted' => '0',
            'audited' => '0',
            'mass_update' => '0',
            'duplicate_merge' => '0',
            'reportable' => '0',
            'importable' => 'true',
            'ext1' => NULL,
            'ext2' => NULL,
            'ext3' => NULL,
            'ext4' => NULL,
            'label' => 'LBL_DISPLAY_IN_WORKLOG',
            'name' => 'display_in_worklog_c',
            'id' => 'Notesdisplay_in_worklog_c',
        ),
    ),

	'language'=> array(
		array('from'=> '<basepath>/language/ModuleBuilder/language/en_us.lang.php',
			  'to_module'=> 'ModuleBuilder',
			  'language'=>'en_us'
		),		
	),
);
