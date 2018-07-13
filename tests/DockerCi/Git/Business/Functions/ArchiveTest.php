<?php
namespace DockerCiTest\Git\Business\Functions;

use DataProvider\GitArchiveDataProvider;
use DockerCi\Git\Business\Functions\Archive;
use DockerCi\Git\Business\Git\GitShell;

class ArchiveTest extends \Codeception\Test\Unit
{

    /**
     * @group DockerCi
     * @group Git
     * @group Business
     * @group Functions
     * @group Archive
     * @group Unit
     */
    public function testArchive()
    {
        $dataProvider = new GitArchiveDataProvider();
        $dataProvider
            ->setRemote('remote')
            ->setPath('path')
            ->setFilename('filename')
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
                $this->equalTo('archive --remote=%s HEAD:%s %s | tar -x -C %s'),
                $this->equalTo('remote'),
                $this->equalTo('path'),
                $this->equalTo('filename'),
                $this->equalTo('target')
            )
            ->willReturn('Testing');

        $archive = new Archive($gitShell);
        $archive->archive($dataProvider);
    }
}