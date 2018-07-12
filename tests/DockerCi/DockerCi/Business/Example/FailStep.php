<?php


namespace DockerCiTest\DockerCi\Business\Example;


use DockerCi\StepEngine\Business\Exception\StepException;
use DockerCi\StepEngine\Business\Step\StepInterface;

class FailStep extends TestStep implements StepInterface
{
    /**
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function postCheck(): void
    {
        throw new StepException('Test Exception');
    }
}