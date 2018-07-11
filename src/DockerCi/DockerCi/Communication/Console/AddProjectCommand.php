<?php


namespace DockerCi\DockerCi\Communication\Console;


use DataProvider\ProjectDataProvider;
use DockerCi\DockerCi\Business\Project\Exception\ProjectException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Xervice\Console\Command\AbstractCommand;
use Xervice\Core\Locator\Locator;

/**
 * @method \DockerCi\DockerCi\DockerCiFacade getFacade()
 */
class AddProjectCommand extends AbstractCommand
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
            $this->getFacade()->addProject($project);
        } catch (\Exception $e) {
            Locator::getInstance()->exceptionHandler()->facade()->handleException($e);
        }
    }

}