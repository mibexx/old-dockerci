<?php
namespace DockerCiTest\Docker;

use Xervice\Core\Locator\Dynamic\DynamicLocator;

/**
 * @method \DockerCi\Docker\DockerFacade getFacade()
 */
class FacadeTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @group DockerCi
     * @group Docker
     * @group Facade
     * @group Integration
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function testRunDockerCommand()
    {
        $result = $this->getFacade()->runDockerCommand(
            'version'
        );

        $this->assertContains('Version:', $result);
        $this->assertContains('API version:', $result);
    }
}