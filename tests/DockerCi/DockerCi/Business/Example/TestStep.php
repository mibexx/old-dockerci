<?php


namespace DockerCiTest\DockerCi\Business\Example;


use DataProvider\DockerCiDataProvider;
use DataProvider\DockerCiMessageDataProvider;
use DockerCi\StepEngine\Business\Step\AbstractStep;

class TestStep extends AbstractStep
{
    public function preCheck(): void
    {

    }

    public function postCheck(): void
    {

    }

    public function execute(): void
    {
        $this->getData()->addMessage(
            (new DockerCiMessageDataProvider())->setMessage('This is a Test')
        );
    }

    /**
     * @return \DataProvider\DockerCiDataProvider
     */
    private function getData(): DockerCiDataProvider
    {
        return $this->dataProvider;
    }

}