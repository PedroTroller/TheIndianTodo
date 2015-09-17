<?php

namespace AppBundle\Command;

use AppBundle\Entity\Memo;
use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class ImportCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName('app:memo:import')
            ->setDescription('Command line interface to load memo from a CSV file')
            ->addArgument('file', InputArgument::REQUIRED, 'Path to the CSV file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $file = $input->getArgument('file');

        if (false === file_exists($file)) {
            throw new FileNotFoundException(sprintf('File "%s" not found', $file));
        }

        $tasks = explode("\n", file_get_contents($file));

        $memo = new Memo();

        foreach ($tasks as $title) {
            $task = new Task();
            $task->setTitle($title);
            $task->setMemo($memo);
        }

        $em->persist($memo);
        $em->flush();
    }
}
