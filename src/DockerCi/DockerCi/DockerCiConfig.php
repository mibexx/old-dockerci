<?php
declare(strict_types=1);


namespace DockerCi\DockerCi;


use Xervice\Config\XerviceConfig;
use Xervice\Core\Config\AbstractConfig;

class DockerCiConfig extends AbstractConfig
{
    public const BUILD_DIR = 'build.dir';

    /**
     * @return string
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function getBuildDir(): string
    {
        return $this->get(
            self::BUILD_DIR,
            $this->get(XerviceConfig::APPLICATION_PATH) . '/builds'
        );
    }
}