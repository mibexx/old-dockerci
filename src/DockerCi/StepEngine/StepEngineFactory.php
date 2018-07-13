<?php
declare(strict_types=1);


namespace DockerCi\StepEngine;


use DockerCi\StepEngine\Business\Engine\StepEngine;
use DockerCi\StepEngine\Business\Engine\StepEngineInterface;
use DockerCi\StepEngine\Business\Step\StepCollection;
use Xervice\Core\Factory\AbstractFactory;
use Xervice\DataProvider\DataProvider\AbstractDataProvider;

/**
 * @method \DockerCi\StepEngine\StepEngineConfig getConfig()
 */
class StepEngineFactory extends AbstractFactory
{
    /**
     * @param \DockerCi\StepEngine\Business\Step\StepCollection $stepCollection
     * @param \Xervice\DataProvider\DataProvider\AbstractDataProvider $dataProvider
     *
     * @return \DockerCi\StepEngine\Business\Engine\StepEngineInterface
     */
    public function createStepEngine(StepCollection $stepCollection, AbstractDataProvider $dataProvider): StepEngineInterface
    {
        return new StepEngine(
            $stepCollection,
            $dataProvider
        );
    }
}