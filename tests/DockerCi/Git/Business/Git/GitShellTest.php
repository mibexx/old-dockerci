<?php
namespace DockerCiTest\Git\Business\Git;

use DockerCi\Git\Business\Git\GitShell;
use Xervice\Shell\ShellFacade;

class GitShellTest extends \Codeception\Test\Unit
{
    /**
     * @group DockerCi
     * @group Git
     * @group Business
     * @group Git
     * @group GitShell
     * @group Unit
     */
    public function testRunGit()
    {
        $shellFacade = $this->getShellFacade();

        $gitShell = new GitShell(
            $shellFacade,
            'git-un'
        );

        $this->assertEquals(
            'myUnitTest',
            $gitShell->runGit('unit', 'param1', 'param2')
        );
    }

    /**
     * @return \Xervice\Shell\ShellFacade
     */
    private function getShellFacade(): ShellFacade
    {
        $shellFacade = $this
            ->getMockBuilder(ShellFacade::class)
            ->setMethods(['runCommand'])
            ->disableOriginalConstructor()
            ->getMock();

        $shellFacade
            ->expects($this->once())
            ->method('runCommand')
            ->with(
                $this->equalTo('git-un unit'),
                $this->equalTo('param1'),
                $this->equalTo('param2')
            )
            ->willReturn('myUnitTest');

        return $shellFacade;
    }
}