<?php

/**
 * @copyright
 * @author
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace MysqldumpProcess;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AnalyzeCommand extends Command {
    protected function configure() {
        $this
                ->setName('analyze')
                ->setDescription('Analyze mysql dump file')
                ->addArgument('file_name', InputOption::VALUE_REQUIRED)
                //->addOption('opt1', null, InputOption::VALUE_REQUIRED, 'Option1')
                //->addOption('opt2', null, InputOption::VALUE_OPTIONAL, 'Option2', '1')
                ->setHelp('Analyze mysql dump file');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $io = new SymfonyStyle($input, $output);
        $io->title('mysqldump-analyze');

        $io->text("File to open: " . $input->getArgument('file_name'));
        $analyzer = new Analyzer($input->getArgument('file_name'));
        $editor = new Editor($analyzer, $input->getArgument('file_name'));
        $analyzer->saveToFile();

        $io->success('Command executed successfully.');
    }

    /**
     * Check if all required arguments are passed.
     *
     * @param InputInterface $input
     * @param array $requiredValues
     * @throws \InvalidArgumentException
     */
    protected function validateRequired(InputInterface $input, array $requiredValues = array()) {

        $errorMsq = '';
        foreach ($requiredValues as $requiredValue) {
            if (!$input->getOption($requiredValue)) {
                $errorMsq .= "Required option '--$requiredValue' missing.\n";
            }
        }

        if ($errorMsq) {
            throw new \InvalidArgumentException($errorMsq);
        }
    }
}