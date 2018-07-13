<?php
declare(strict_types=1);


namespace DockerCi\DockerCi\Business\Ci\Steps;


use DataProvider\DockerCiDataProvider;
use DataProvider\DockerCiMessageDataProvider;
use DataProvider\ProjectDataProvider;
use DockerCi\StepEngine\Business\Step\AbstractStep as StepEngineAbstractStep;
use Xervice\DataProvider\DataProvider\DataProviderInterface;

abstract class AbstractStep extends StepEngineAbstractStep
{
    /**
     * @return \DataProvider\ProjectDataProvider
     */
    protected function getProject(): ProjectDataProvider
    {
        return $this->getData()->getProject();
    }

    /**
     * @param string $message
     * @param string $group
     */
    protected function addMessage(string $message, string $group): void
    {
        $dataProvider = new DockerCiMessageDataProvider();
        $dataProvider
            ->setMessage($message)
            ->setGroup($group);

        $this->getData()->addMessage($dataProvider);
    }

    /**
     * @return \DataProvider\DockerCiDataProvider
     */
    protected function getData(): DataProviderInterface
    {
        return $this->dataProvider;
    }
}