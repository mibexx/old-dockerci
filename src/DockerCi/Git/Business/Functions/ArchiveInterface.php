<?php

namespace DockerCi\Git\Business\Functions;

use DataProvider\GitArchiveDataProvider;

interface ArchiveInterface
{
    /**
     * @param \DataProvider\GitArchiveDataProvider $archiveDataProvider
     *
     * @return string
     */
    public function archiveOneFile(GitArchiveDataProvider $archiveDataProvider): string;
}