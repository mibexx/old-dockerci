<?php
declare(strict_types=1);


namespace DockerCi\DockerCi\Communication\Console;


use DataProvider\ProjectDataProvider;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Xervice\Core\Locator\Locator;

/**
 * @method \DockerCi\DockerCi\DockerCiFacade getFacade()
 */
class AddProjectCommand extends AbstractDockerCiCommand
{
    protected function configure()
    {
        $this
            ->setName('ci:project:add')
            ->setDescription('Add a new project')
            ->addArgument('name', InputArgument::REQUIRED, 'Project name')
            ->addArgument('repository', InputArgument::REQUIRED, 'Repository');
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
        $project = new ProjectDataProvider();
        $project->setName($input->getArgument('name'));
        $project->setRepository($input->getArgument('repository'));

        try {
            $this->initDatabase();
            $this->getFacade()->addProject($project);
        } catch (\Exception $e) {
            Locator::getInstance()->exceptionHandler()->facade()->handleException($e);
        }
    }

}