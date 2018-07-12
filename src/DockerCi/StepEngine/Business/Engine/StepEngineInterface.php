<?php

namespace DockerCi\StepEngine\Business\Engine;

interface StepEngineInterface
{
    /**
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function executeStep();
}