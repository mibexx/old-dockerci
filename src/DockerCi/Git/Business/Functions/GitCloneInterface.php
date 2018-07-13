<?php

namespace DockerCi\Git\Business\Functions;

use DataProvider\GitCloneDataProvider;

interface GitCloneInterface
{
    /**
     * @param \DataProvider\GitArchiveDataProvider $archiveDataProvider
     *
     * @return string
     */
    public function clone(GitCloneDataProvider $dataProvider): string;
}