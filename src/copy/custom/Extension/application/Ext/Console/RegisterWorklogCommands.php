<?php

// Register worklog functions
Sugarcrm\Sugarcrm\Console\CommandRegistry\CommandRegistry::getInstance()
    ->addCommand(new Sugarcrm\Sugarcrm\custom\Worklog\Console\Command\Migrate());