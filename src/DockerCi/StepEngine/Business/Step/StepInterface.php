<?php


namespace DockerCi\StepEngine\Business\Step;


use Xervice\DataProvider\DataProvider\AbstractDataProvider;

interface StepInterface
{
    /**
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function preCheck(): void;

    /**
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function postCheck(): void;

    /**
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function execute(): void;

    /**
     * @param \Xervice\DataProvider\DataProvider\AbstractDataProvider $dataProvider
     */
    public function setData(AbstractDataProvider $dataProvider): void;
}