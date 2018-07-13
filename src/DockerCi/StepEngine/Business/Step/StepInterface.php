<?php
declare(strict_types=1);


namespace DockerCi\StepEngine\Business\Step;


use Xervice\DataProvider\DataProvider\DataProviderInterface;

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
     * @return bool
     */
    public function isNeeded(): bool;

    /**
     * @param \Xervice\DataProvider\DataProvider\DataProviderInterface $dataProvider
     */
    public function setData(DataProviderInterface $dataProvider): void;
}