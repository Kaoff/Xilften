<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 02/03/2018
 * Time: 16:42
 */

namespace AppBundle\Command;

use AppBundle\Manager\MovieManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MovieImportCommand extends Command
{
    /** @var MovieManager */
    private $movieManager;

    public function __construct(MovieManager $movieManager)
    {
        $this->movieManager = $movieManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:import:movies')
            ->setDescription('Import movies by CSV file.')
            ->setHelp('This command will take a CSV file to import movies.')
            ->addArgument('csv', InputArgument::REQUIRED, 'CSV File.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Import Movies - ' . $input->getArgument('csv'),
            '==========================',
            ''
        ]);

        $csv = fopen($input->getArgument('csv'), 'r');

        while (($movieCsv = fgetcsv($csv, 1000, ',')) !== FALSE) {
            $movie = $this->movieManager->createMovie($movieCsv[0], $movieCsv[1], 'dQw4w9WgXcQ');
            $output->writeln($movie->getTitle());
        }

        $output->writeln([
            '',
            'Done :)',
            ''
        ]);
    }
}