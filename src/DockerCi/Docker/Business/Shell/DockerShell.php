<?php
declare(strict_types=1);


namespace DockerCi\Docker\Business\Shell;


use DockerCi\Shell\ShellFacade;

class DockerShell implements DockerShellInterface
{
    /**
     * @var \DockerCi\Shell\ShellFacade
     */
    private $shellFacade;

    /**
     * @var string
     */
    private $dockerCommand;

    /**
     * DockerShell constructor.
     *
     * @param \DockerCi\Shell\ShellFacade $shellFacade
     * @param string $dockerCommand
     */
    public function __construct(ShellFacade $shellFacade, string $dockerCommand)
    {
        $this->shellFacade = $shellFacade;
        $this->dockerCommand = $dockerCommand;
    }

    /**
     * @param string $command
     * @param string ...$params
     *
     * @return string
     */
    public function runDockerShell(string $command, ...$params): string
    {
        $dockerCommand = sprintf(
            '%s %s',
            $this->dockerCommand,
            $command
        );

        return $this->shellFacade->runCommand($dockerCommand, ...$params);
    }


}