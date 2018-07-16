<?php
namespace DockerCiTest\Git\Business\Functions;

use DockerCi\Git\Business\Functions\Archive;
use DockerCi\Git\Business\Functions\GitReset;
use DockerCi\Git\Business\Git\GitShell;

class GitResetTest extends \Codeception\Test\Unit
{

    /**
     * @group DockerCi
     * @group Git
     * @group Business
     * @group Functions
     * @group Reset
     * @group Unit
     */
    public function testRestHard()
    {
        $gitShell = $this
            ->getMockBuilder(GitShell::class)
            ->setMethods(['runGit'])
            ->disableOriginalConstructor()
            ->getMock();

        $gitShell
            ->expects($this->once())
            ->method('runGit')
            ->with(
                $this->equalTo('--git-dir=%s --work-tree=%s reset --hard HEAD'),
                $this->equalTo('test-path/.git'),
                $this->equalTo('test-path')
            )
            ->willReturn('Testing');

        $reset = new GitReset($gitShell);
        $reset->resetHard('test-path');
    }
}