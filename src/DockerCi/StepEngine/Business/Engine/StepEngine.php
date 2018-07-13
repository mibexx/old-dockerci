<?php
declare(strict_types=1);


namespace DockerCi\StepEngine\Business\Engine;


use DockerCi\StepEngine\Business\Step\StepCollection;
use Xervice\DataProvider\DataProvider\DataProviderInterface;

class StepEngine implements StepEngineInterface
{
    /**
     * @var \DockerCi\StepEngine\Business\Step\StepCollection
     */
    private $stepCollection;

    /**
     * @var \Xervice\DataProvider\DataProvider\DataProviderInterface
     */
    private $dataProvider;

    /**
     * StepEngine constructor.
     *
     * @param \DockerCi\StepEngine\Business\Step\StepCollection $stepCollection
     * @param \Xervice\DataProvider\DataProvider\DataProviderInterface $dataProvider
     */
    public function __construct(
        StepCollection $stepCollection,
        DataProviderInterface $dataProvider
    ) {
        $this->stepCollection = $stepCollection;
        $this->dataProvider = $dataProvider;
    }

    /**
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function executeStep(): DataProviderInterface
    {
        foreach ($this->stepCollection as $step) {
            $step->setData($this->dataProvider);
            if ($step->isNeeded()) {
                $step->preCheck();
                $step->execute();
                $step->postCheck();
            }
        }

        return $this->dataProvider;
    }


}