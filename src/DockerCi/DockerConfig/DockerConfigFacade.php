<?php
declare(strict_types=1);


namespace DockerCi\DockerConfig;


use DataProvider\DockerConfigDataProvider;
use DataProvider\DockerConfigFileListDataProvider;
use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \DockerCi\DockerConfig\DockerConfigFactory getFactory()
 * @method \DockerCi\DockerConfig\DockerConfigConfig getConfig()
 * @method \DockerCi\DockerConfig\DockerConfigClient getClient()
 */
class DockerConfigFacade extends AbstractFacade
{
    /**
     * @param \DataProvider\DockerConfigFileListDataProvider $fileListDataProvider
     *
     * @return \DataProvider\DockerConfigDataProvider
     * @throws \DockerCi\DockerConfig\Business\Exception\ConfigException
     */
    public function getDockerConfig(DockerConfigFileListDataProvider $fileListDataProvider): DockerConfigDataProvider
    {
        return $this->getFactory()->createConfigLoader($fileListDataProvider)->getConfig();
    }
}