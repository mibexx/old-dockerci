<?php
namespace DockerCiTest\Shell;

use Xervice\Core\Locator\Dynamic\DynamicLocator;

/**
 * @method \DockerCi\Shell\ShellFacade getFacade()
 */
class FacadeTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @group DockerCi
     * @group Shell
     * @group Facade
     * @group Integration
     */
    public function testExecuteCommand()
    {
        $this->assertEquals(
            'This is a test!',
            $this->getFacade()->runCommand(
                'cat %s',
                __DIR__ . '/data/test1'
            )
        );
    }
}