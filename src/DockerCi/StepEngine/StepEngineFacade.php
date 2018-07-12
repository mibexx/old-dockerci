<?php


namespace DockerCi\StepEngine;


use DockerCi\StepEngine\Business\Step\StepCollection;
use Xervice\Core\Facade\AbstractFacade;
use Xervice\DataProvider\DataProvider\AbstractDataProvider;

/**
 * @method \DockerCi\StepEngine\StepEngineFactory getFactory()
 * @method \DockerCi\StepEngine\StepEngineConfig getConfig()
 * @method \DockerCi\StepEngine\StepEngineClient getClient()
 */
class StepEngineFacade extends AbstractFacade
{
    /**
     * @param \DockerCi\StepEngine\Business\Step\StepCollection $stepCollection
     * @param \Xervice\DataProvider\DataProvider\AbstractDataProvider $dataProvider
     *
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function runStepEngine(
        StepCollection $stepCollection,
        AbstractDataProvider $dataProvider
    )
    {
        $this->getFactory()->createStepEngine($stepCollection, $dataProvider)->executeStep();
    }
}