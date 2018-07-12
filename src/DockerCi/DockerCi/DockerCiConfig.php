<?php


namespace DockerCi\DockerCi;


use Xervice\Config\XerviceConfig;
use Xervice\Core\Config\AbstractConfig;

class DockerCiConfig extends AbstractConfig
{
    const BUILD_DIR = 'build.dir';

    /**
     * @return string
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function getBuildDir()
    {
        return $this->get(
            self::BUILD_DIR,
            $this->get(XerviceConfig::APPLICATION_PATH) . '/builds'
        );
    }
}