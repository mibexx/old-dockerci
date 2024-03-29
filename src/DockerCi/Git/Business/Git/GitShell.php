<?php
declare(strict_types=1);


namespace DockerCi\Git\Business\Git;


use Xervice\Shell\ShellFacade;

class GitShell implements GitShellInterface
{
    /**
     * @var \Xervice\Shell\ShellFacade
     */
    private $shellFacade;

    /**
     * @var string
     */
    private $gitCommand;

    /**
     * GitShell constructor.
     *
     * @param \Xervice\Shell\ShellFacade $shellFacade
     * @param string $gitCommand
     */
    public function __construct(
        ShellFacade $shellFacade,
        string $gitCommand
    )
    {
        $this->shellFacade = $shellFacade;
        $this->gitCommand = $gitCommand;
    }


    /**
     * @param string $command
     * @param string ...$params
     *
     * @return string
     */
    public function runGit(string $command, ...$params): string
    {
        return $this->shellFacade->runCommand(
            sprintf(
                '%s %s',
                $this->gitCommand,
                $command
            ),
            ...$params
        );
    }


}