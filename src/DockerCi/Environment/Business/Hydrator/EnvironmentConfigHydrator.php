<?php


namespace DockerCi\Environment\Business\Hydrator;


use DataProvider\DockerConfigDataProvider;
use DataProvider\EnvironmentConfigDataProvider;

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
     */
    public function hydrate(): DockerConfigDataProvider
    {
        foreach ($this->configData as $name => $data) {
            $conf = new EnvironmentConfigDataProvider();
            $conf->setName($name);
            $conf->setType($data['type']);

            unset($data['type']);

            $conf->setContext($data);

            $this->configDataProvider->addEnvironment($conf);
        }

        return $this->configDataProvider;
    }
}