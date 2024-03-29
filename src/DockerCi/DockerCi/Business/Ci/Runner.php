<?php
declare(strict_types=1);


namespace DockerCi\DockerCi\Business\Ci;


use DataProvider\DockerCiDataProvider;
use DockerCi\StepEngine\Business\Step\StepCollection;
use DockerCi\StepEngine\StepEngineFacade;
use Xervice\DataProvider\DataProvider\DataProviderInterface;

class Runner implements RunnerInterface
{
    /**
     * @var \DockerCi\StepEngine\StepEngineFacade
     */
    private $stepEngineFacade;

    /**
     * @var \DockerCi\StepEngine\Business\Step\StepCollection
     */
    private $stepCollection;

    /**
     * Runner constructor.
     *
     * @param \DockerCi\StepEngine\StepEngineFacade $stepEngineFacade
     * @param \DockerCi\StepEngine\Business\Step\StepCollection $stepCollection
     */
    public function __construct(
        StepEngineFacade $stepEngineFacade,
        StepCollection $stepCollection
    ) {
        $this->stepEngineFacade = $stepEngineFacade;
        $this->stepCollection = $stepCollection;
    }

    /**
     * @param \DataProvider\DockerCiDataProvider $dataProvider
     *
     * @return \DataProvider\DockerCiDataProvider
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function run(DockerCiDataProvider $dataProvider): DataProviderInterface
    {
        return $this->stepEngineFacade->runStepEngine(
            $this->stepCollection,
            $dataProvider
        );
    }

}