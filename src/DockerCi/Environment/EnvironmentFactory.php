<?php


namespace DockerCi\Environment;


use DataProvider\DockerConfigDataProvider;
use DockerCi\Environment\Business\Hydrator\EnvironmentConfigHydrator;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\Environment\EnvironmentConfig getConfig()
 */
class EnvironmentFactory extends AbstractFactory
{
    /**
     * @param array $configData
     * @param \DataProvider\DockerConfigDataProvider $configDataProvider
     *
     * @return \DockerCi\Environment\Business\Hydrator\EnvironmentConfigHydrator
     */
    public function getEnvironmentConfigHydrator(
        array $configData,
        DockerConfigDataProvider $configDataProvider
    )
    {
        return new EnvironmentConfigHydrator(
            $configData,
            $configDataProvider
        );
    }
}