<?php


namespace DockerCi\ExceptionHandler;


use Xervice\Core\Config\AbstractConfig;

class ExceptionHandlerConfig extends AbstractConfig
{
    public const IS_DEBUG = 'is.debug';

    public const SHUTDOWN_IF_ERROR = 'shutdown.if.error';

    /**
     * @return bool
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function isDebug()
    {
        return $this->get(self::IS_DEBUG, false);
    }

    /**
     * @return bool
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function shutdownIfError()
    {
        return $this->get(self::SHUTDOWN_IF_ERROR, true);
    }
}