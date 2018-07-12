<?php


namespace DockerCi\DockerCi\Communication\Console;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \DockerCi\DockerCi\DockerCiFacade getFacade()
 */
class RunProjectCommand extends AbstractDockerCiCommand
{
    protected function configure()
    {
        $this
            ->setName('ci:project:run')
            ->setDescription('Run project')
            ->addArgument('project_id', InputArgument::REQUIRED, 'Project-ID');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null|void
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->initDatabase();
    }

}