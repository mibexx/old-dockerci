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
                $this->equalTo('reset --hard HEAD %s'),
                $this->equalTo('test-path')
            )
            ->willReturn('Testing');

        $archive = new GitReset($gitShell);
        $archive->resetHard('test-path');
    }
}