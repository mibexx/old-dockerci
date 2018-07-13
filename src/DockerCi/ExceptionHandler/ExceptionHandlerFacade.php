<?php
declare(strict_types=1);


namespace DockerCi\ExceptionHandler;


use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \DockerCi\ExceptionHandler\ExceptionHandlerFactory getFactory()
 * @method \DockerCi\ExceptionHandler\ExceptionHandlerConfig getConfig()
 * @method \DockerCi\ExceptionHandler\ExceptionHandlerClient getClient()
 */
class ExceptionHandlerFacade extends AbstractFacade
{
    /**
     * @param \Exception $exception
     *
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function handleException(\Exception $exception): void
    {
        $this->getFactory()->createExceptionHandler()->handleException($exception);
    }
}