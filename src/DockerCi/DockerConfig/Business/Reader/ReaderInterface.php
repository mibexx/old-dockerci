<?php

namespace DockerCi\DockerConfig\Business\Reader;

use DataProvider\DockerConfigFileDataProvider;

interface ReaderInterface
{
    /**
     * @param \DataProvider\DockerConfigFileDataProvider $dataProvider
     *
     * @return array
     */
    public function getArrayFromFile(DockerConfigFileDataProvider $dataProvider): array;
}