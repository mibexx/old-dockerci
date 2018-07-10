<?php


namespace DockerCi\DockerConfig\Business\Hydrator;


use DataProvider\DockerConfigDataProvider;

interface HydratorInterface
{
    /**
     * @param array $data
     * @param \DataProvider\DockerConfigDataProvider $dataProvider
     *
     * @return \DataProvider\DockerConfigDataProvider
     */
    public function hydrateConfig(array $data, DockerConfigDataProvider $dataProvider): DockerConfigDataProvider;
}