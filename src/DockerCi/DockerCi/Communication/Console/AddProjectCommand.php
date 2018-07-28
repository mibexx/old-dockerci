<?php
declare(strict_types=1);


namespace DockerCi\DockerCi\Communication\Console;


use DataProvider\ProjectDataProvider;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \DockerCi\DockerCi\DockerCiFacade getFacade()
 * @method \DockerCi\DockerCi\DockerCiFactory getFactory()
 */
class AddProjectCommand extends AbstractDockerCiCommand
{
    /**
     *
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure(): void
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
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $project = new ProjectDataProvider();
        $project->setName($input->getArgument('name'));
        $project->setRepository($input->getArgument('repository'));

        try {
            $this->initApplication();
            $this->getFacade()->addProject($project);
        } catch (\Exception $e) {
            $this->getFactory()->getExceptionHandlerFacade()->handleException($e);
        }
    }

}