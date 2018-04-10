<?php

require 'clients/base/filters/operators/operators.php';

$viewdefs['base']['filter']['operators']['worklog'] = array(
    '$contains' => 'LBL_WORKLOG_OPERATOR_CONTAINS',
    '$not_contains' => 'LBL_WORKLOG_OPERATOR_NOT_CONTAINS',
);