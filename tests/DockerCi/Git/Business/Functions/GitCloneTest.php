<?php
namespace DockerCiTest\Git\Business\Functions;

use DataProvider\GitArchiveDataProvider;
use DataProvider\GitCloneDataProvider;
use DockerCi\Git\Business\Functions\Archive;
use DockerCi\Git\Business\Functions\GitClone;
use DockerCi\Git\Business\Git\GitShell;

class GitCloneTest extends \Codeception\Test\Unit
{

    /**
     * @group DockerCi
     * @group Git
     * @group Business
     * @group Functions
     * @group Archive
     * @group Unit
     */
    public function testClone()
    {
        $dataProvider = new GitCloneDataProvider();
        $dataProvider
            ->setRemote('remote')
            ->setTarget('target');

        $gitShell = $this
            ->getMockBuilder(GitShell::class)
            ->setMethods(['runGit'])
            ->disableOriginalConstructor()
            ->getMock();

        $gitShell
            ->expects($this->once())
            ->method('runGit')
            ->with(
                $this->equalTo('clone %s %s'),
                $this->equalTo('remote'),
                $this->equalTo('target')
            )
            ->willReturn('Testing');

        $archive = new GitClone($gitShell);
        $archive->clone($dataProvider);
    }
}