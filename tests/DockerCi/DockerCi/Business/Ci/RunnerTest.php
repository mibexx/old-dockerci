<?php
namespace DockerCiTest\DockerCi\Business\Ci;

use DataProvider\DockerCiDataProvider;
use DockerCi\DockerCi\Business\Ci\Runner;
use DockerCi\StepEngine\Business\Step\StepCollection;
use DockerCiTest\DockerCi\Business\Example\FailStep;
use DockerCiTest\DockerCi\Business\Example\TestStep;
use Xervice\Core\Locator\Locator;

class RunnerTest extends \Codeception\Test\Unit
{
    /**
     * @group DockerCi
     * @group Business
     * @group Ci
     * @group Runner
     * @group Unit
     */
    public function testRun()
    {
        $stepCollection = new StepCollection(
            [
                new TestStep()
            ]
        );

        $stepEngineFacade = $this->getStepEngineFacade();

        $runner = new Runner(
            $stepEngineFacade,
            $stepCollection
        );

        $testDataProvider = new DockerCiDataProvider();
        $testDataProvider = $runner->run($testDataProvider);

        $this->assertEquals(
            'This is a Test',
            $testDataProvider->getMessages()[0]->getMessage()
        );
    }

    /**
     * @group DockerCi
     * @group Business
     * @group Ci
     * @group Runner
     * @group Unit
     *
     * @expectedException \DockerCi\StepEngine\Business\Exception\StepException
     * @expectedExceptionMessage Test Exception
     */
    public function testFailRun()
    {
        $stepCollection = new StepCollection(
            [
                new FailStep()
            ]
        );

        $stepEngineFacade = $this->getStepEngineFacade();

        $runner = new Runner(
            $stepEngineFacade,
            $stepCollection
        );

        $testDataProvider = new DockerCiDataProvider();
        $testDataProvider = $runner->run($testDataProvider);
    }

    /**
     * @return \DockerCi\StepEngine\StepEngineFacade
     */
    private function getStepEngineFacade()
    {
        return Locator::getInstance()->stepEngine()->facade();
    }
}