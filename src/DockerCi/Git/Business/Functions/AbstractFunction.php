<?php


namespace DockerCi\Git\Business\Functions;


use DockerCi\Git\Business\Git\GitShellInterface;

abstract class AbstractFunction
{
    /**
     * @var \DockerCi\Git\Business\Git\GitShellInterface
     */
    protected $gitShell;

    /**
     * Checkout constructor.
     *
     * @param \DockerCi\Git\Business\Git\GitShellInterface $gitShell
     */
    public function __construct(GitShellInterface $gitShell)
    {
        $this->gitShell = $gitShell;
    }
}