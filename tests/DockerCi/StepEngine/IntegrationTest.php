<?php

namespace DockerCiTest\StepEngine;

use DockerCi\StepEngine\Business\Step\AbstractStep;
use DockerCi\StepEngine\Business\Step\StepCollection;
use Xervice\Core\Locator\Dynamic\DynamicLocator;
use Xervice\DataProvider\DataProvider\AbstractDataProvider;

/**
 * @method \DockerCi\StepEngine\StepEngineFacade getFacade()
 */
class IntegrationTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @group DockerCi
     * @group StepEngine
     * @group Integration
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \DockerCi\StepEngine\Business\Exception\StepException
     */
    public function testRunStepEngine()
    {
        $stepOne = $this->createStepMock();

        $stepOne
            ->expects($this->once())
            ->method('preCheck');

        $stepOne
            ->expects($this->once())
            ->method('execute');

        $stepOne
            ->expects($this->once())
            ->method('postCheck');

        $stepTwo = $this->createStepMock();

        $stepTwo
            ->expects($this->once())
            ->method('preCheck');

        $stepTwo
            ->expects($this->once())
            ->method('execute');

        $stepTwo
            ->expects($this->once())
            ->method('postCheck');

        $stepCollection = new StepCollection(
            [
                $stepOne,
                $stepTwo
            ]
        );

        $dataProvider = $this->getExampleDataProvider();

        $this->assertEquals(
            $dataProvider,
            $this->getFacade()->runStepEngine(
                $stepCollection,
                $dataProvider
            )
        );
    }

    /**
     * @return \Xervice\DataProvider\DataProvider\AbstractDataProvider
     */
    public function getExampleDataProvider(): AbstractDataProvider
    {
        return $this
            ->getMockBuilder(AbstractDataProvider::class)
            ->getMock();
    }

    /**
     * @return \DockerCi\StepEngine\Business\Step\AbstractStep
     */
    private function createStepMock(): AbstractStep
    {
        $step = $this
            ->getMockBuilder(AbstractStep::class)
            ->setMethods(
                [
                    'preCheck',
                    'postCheck',
                    'execute',
                    'isNeeded'
                ]
            )
            ->getMock();

        $step
            ->expects($this->once())
            ->method('isNeeded')
            ->willReturn(true);

        return $step;
    }
}