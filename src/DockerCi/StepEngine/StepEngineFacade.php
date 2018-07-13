<?php
declare(strict_types=1);


namespace DockerCi\StepEngine;


use DockerCi\StepEngine\Business\Step\StepCollection;
use Xervice\Core\Facade\AbstractFacade;
use Xervice\DataProvider\DataProvider\DataProviderInterface;

/**
 * @method \DockerCi\StepEngine\StepEngineFactory getFactory()
 */
class StepEngineFacade extends AbstractFacade
{
    /**
     * @param \DockerCi\StepEngine\Business\Step\StepCollection $stepCollection
     * @param \Xervice\DataProvider\DataProvider\DataProviderInterface $dataProvider
     *
     * @return \Xervice\DataProvider\DataProvider\DataProviderInterface
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function runStepEngine(
        StepCollection $stepCollection,
        DataProviderInterface $dataProvider
    ): DataProviderInterface
    {
        return $this->getFactory()->createStepEngine($stepCollection, $dataProvider)->executeStep();
    }
}