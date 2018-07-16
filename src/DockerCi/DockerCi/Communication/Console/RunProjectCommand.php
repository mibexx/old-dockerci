<?php
declare(strict_types=1);


namespace DockerCi\DockerCi\Communication\Console;


use DataProvider\ProjectDataProvider;
use DockerCi\StepEngine\Business\Exception\StepException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \DockerCi\DockerCi\DockerCiFacade getFacade()
 */
class RunProjectCommand extends AbstractDockerCiCommand
{
    /**
     *
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure(): void
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
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->initDatabase();

        $project = $this->createProjectDataProvider($input);

        try {
            $this->runProjectCi($output, $project);
        } catch (StepException $exception) {
            if ($output->isVerbose()) {
                $output->writeln($exception->getMessage());
            }
            if ($output->isDebug()) {
                $output->writeln($exception->getTraceAsString());
            }
        }
    }

    /**
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param $project
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    protected function runProjectCi(OutputInterface $output, $project): void
    {
        $dockerCiDataProvider = $this->getFacade()->prepareCi($project);
        $dockerCiDataProvider = $this->getFacade()->runCi($dockerCiDataProvider);

        if ($output->isVerbose()) {
            foreach ($dockerCiDataProvider->getMessages() as $message) {
                $output->writeln(
                    sprintf(
                        '[%s] %s',
                        $message->getGroup(),
                        $message->getMessage()
                    )
                );
            }
        }
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return \DataProvider\ProjectDataProvider
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function createProjectDataProvider(InputInterface $input): ProjectDataProvider
    {
        $project = new ProjectDataProvider();
        $project->setProjectId(
            (int) $input->getArgument('project_id')
        );
        return $project;
    }

}