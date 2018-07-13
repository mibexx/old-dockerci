<?php
declare(strict_types=1);

namespace DockerCi\StepEngine\Business\Engine;

interface StepEngineInterface
{
    /**
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function executeStep();
}