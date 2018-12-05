<?php

namespace Sugarcrm\Sugarcrm\custom\Worklog\Console\Command;

use Sugarcrm\Sugarcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

require_once 'custom/include/SugarFields/Fields/Worklog/SugarFieldWorklogHelpers.php';
require_once 'modules/Administration/Administration.php';

/**
 *
 * Hello World Example
 *
 */
class Migrate extends Command implements InstanceModeInterface
{

    protected function configure()
    {
        $this
            ->setName('worklog:migrate')
            ->setDescription('Migrates the work log field to the comment log')
            ->addArgument(
                'module',
                InputOption::VALUE_REQUIRED,
                'The module of the work log field to migrate'
            )
            ->addArgument(
                'worklog_field',
                InputOption::VALUE_REQUIRED,
                'The work log field to migrate to the comment log'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (version_compare($GLOBALS['sugar_version'], '8.3', '<')) {
            $output->writeln("This command can only be run against Sugar 8.3 or higher");
            exit;
        }

        $module = $input->getArgument('module');
        $coreBean = \BeanFactory::newBean($module);

        if (!is_object($coreBean)) {
            $output->writeln("'{$module}' does not appear to be a valid module");
            exit;
        }

        $field = $input->getArgument('worklog_field');

        if (empty($field)) {
            $output->writeln("A work log field must be selected");
            exit;
        }


        if (!isset($coreBean->field_defs[$field])) {
            $output->writeln("Work log field '{$module}::{$field}' does not exist");
            exit;
        }

        if ($coreBean->field_defs[$field]['type'] !== 'worklog') {
            $output->writeln("Work log field '{$module}::{$field}' does not have a vardef type of 'worklog'");
            exit;
        }

        $relationship = 'commentlog_link';
        if (!$coreBean->load_relationship($relationship)) {
            $output->writeln("The comment log link '{$relationship}' was not found");
            exit;
        }

        $limit = 500;
        $offset = 0;
        $run = true;
        $connection = $GLOBALS['db']->getConnection();

        while ($run) {
            $output->writeln("Processing {$limit} records from offset {$offset}");
            \BeanFactory::clearCache();
            $query = new \SugarQuery();
            $query->select(array(
                'id',
                $field
            ));
            $query->from($coreBean, array('team_security' => false));
            $query->where()
                ->notNull($field)
                ->isNotEmpty($field);

            $query->orderBy('date_entered', 'ASC');
            $query->offset($offset);
            $query->limit($limit);

            $beans = \SugarFieldWorklogHelpers::getBeansFromQuery($query);

            foreach ($beans as $bean) {

                //convert to array as dynamic vars are not permitted on SC
                $beanArray = get_object_vars($bean);
                $logs = \SugarFieldWorklogHelpers::parseJsonValue($beanArray[$field]);

                foreach ($logs as $log) {
                    $commentId = \Sugarcrm\Sugarcrm\Util\Uuid::uuid4();
                    $commentLinkId = \Sugarcrm\Sugarcrm\Util\Uuid::uuid4();
                    $qb1 = $connection->createQueryBuilder();
                    $qb1->insert('commentlog')
                        ->values(
                            array(
                                'id' => '?',
                                'date_entered' => '?',
                                'date_modified' => '?',
                                'modified_user_id' => '?',
                                'created_by' => '?',
                                'deleted' => '?',
                                'entry' => '?',
                            )
                        )
                        ->setParameter(0, $commentId)
                        ->setParameter(1, $log['tsp'])
                        ->setParameter(2, $log['tsp'])
                        ->setParameter(3, $log['usr'])
                        ->setParameter(4, $log['usr'])
                        ->setParameter(5, 0)
                        ->setParameter(6, $log['msg']);

                    $stmt1 = $qb1->execute();

                    $qb2 = $connection->createQueryBuilder();
                    $qb2->insert('commentlog_rel')
                        ->values(
                            array(
                                'id' => '?',
                                'record_id' => '?',
                                'commentlog_id' => '?',
                                'module' => '?',
                                'deleted' => '?',
                            )
                        )
                        ->setParameter(0, $commentLinkId)
                        ->setParameter(1, $bean->id)
                        ->setParameter(2, $commentId)
                        ->setParameter(3, $bean->module_name)
                        ->setParameter(4, 0);

                    $stmt2 = $qb2->execute();
                }

            }

            $beanCount = count($beans);
            $offset = $offset + $beanCount;

            //end loop when done
            if ($beanCount !== $limit) {
                $run = false;
            }
        }
    }
}