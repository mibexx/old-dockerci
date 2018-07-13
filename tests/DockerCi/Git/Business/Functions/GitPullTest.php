<?php
namespace DockerCiTest\Git\Business\Functions;

use DockerCi\Git\Business\Functions\Archive;
use DockerCi\Git\Business\Functions\GitPull;
use DockerCi\Git\Business\Git\GitShell;

class GitPullTest extends \Codeception\Test\Unit
{

    /**
     * @group DockerCi
     * @group Git
     * @group Business
     * @group Functions
     * @group Pull
     * @group Unit
     */
    public function testPull()
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
                $this->equalTo('--git-dir=%s --work-tree=%s pull'),
                $this->equalTo('test-path/.git'),
                $this->equalTo('test-path')
            )
            ->willReturn('Testing');

        $archive = new GitPull($gitShell);
        $archive->pull('test-path');
    }
}