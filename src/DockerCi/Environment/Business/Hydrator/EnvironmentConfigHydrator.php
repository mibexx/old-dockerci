<?php


namespace DockerCi\Environment\Business\Hydrator;


use DataProvider\DockerConfigDataProvider;
use DataProvider\EnvironmentConfigDataProvider;
use DockerCi\DockerConfig\Business\Exception\ConfigException;
use DockerCi\Environment\Business\Exeption\EnvironmentConfigException;

class EnvironmentConfigHydrator
{
    /**
     * @var array
     */
    private $configData;

    /**
     * @var \DataProvider\DockerConfigDataProvider
     */
    private $configDataProvider;

    /**
     * EnvironmentConfigHydrator constructor.
     *
     * @param array $configData
     * @param \DataProvider\DockerConfigDataProvider $configDataProvider
     */
    public function __construct(array $configData, DockerConfigDataProvider $configDataProvider)
    {
        $this->configData = $configData;
        $this->configDataProvider = $configDataProvider;
    }

    /**
     * @return \DataProvider\DockerConfigDataProvider
     * @throws \DockerCi\DockerConfig\Business\Exception\ConfigException
     */
    public function hydrate(): DockerConfigDataProvider
    {
        foreach ($this->configData as $name => $data) {
            $conf = $this->getEnvironmentConfigFromData($name, $data);
            $this->configDataProvider->addEnvironment($conf);
        }

        return $this->configDataProvider;
    }

    /**
     * @param $name
     * @param $data
     *
     * @return \DataProvider\EnvironmentConfigDataProvider
     * @throws \DockerCi\DockerConfig\Business\Exception\ConfigException
     */
    private function getEnvironmentConfigFromData($name, $data): EnvironmentConfigDataProvider
    {
        if (!isset($data['type'])) {
            throw new ConfigException(
                sprintf(
                    'Environment configuration for %s has no field type',
                    $name
                )
            );
        }

        $conf = new EnvironmentConfigDataProvider();
        $conf->setName($name);
        $conf->setType($data['type']);

        unset($data['type']);

        $conf->setContext($data);
        return $conf;
}
}