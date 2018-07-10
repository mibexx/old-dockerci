<?php


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
     */
    public function getDockerConfig(DockerConfigFileListDataProvider $fileListDataProvider): DockerConfigDataProvider
    {
        return $this->getFactory()->createConfigLoader($fileListDataProvider)->getConfig();
    }
}