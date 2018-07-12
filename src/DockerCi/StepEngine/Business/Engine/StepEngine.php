<?php


namespace DockerCi\StepEngine\Business\Engine;


use DockerCi\StepEngine\Business\Step\StepCollection;
use Xervice\DataProvider\DataProvider\AbstractDataProvider;

class StepEngine implements StepEngineInterface
{
    /**
     * @var \DockerCi\StepEngine\Business\Step\StepCollection
     */
    private $stepCollection;

    /**
     * @var \Xervice\DataProvider\DataProvider\AbstractDataProvider
     */
    private $dataProvider;

    /**
     * StepEngine constructor.
     *
     * @param \DockerCi\StepEngine\Business\Step\StepCollection $stepCollection
     * @param \Xervice\DataProvider\DataProvider\AbstractDataProvider $dataProvider
     */
    public function __construct(
        StepCollection $stepCollection,
        AbstractDataProvider $dataProvider
    ) {
        $this->stepCollection = $stepCollection;
        $this->dataProvider = $dataProvider;
    }

    /**
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function executeStep()
    {
        foreach ($this->stepCollection as $step) {
            $step->setData($this->dataProvider);
            $step->preCheck();
            $step->execute();
            $step->postCheck();
        }
    }


}