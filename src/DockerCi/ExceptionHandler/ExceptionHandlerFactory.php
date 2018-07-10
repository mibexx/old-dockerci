<?php


namespace DockerCi\ExceptionHandler;


use DockerCi\ExceptionHandler\Business\Handler\DefaultExceptionHandler;
use DockerCi\ExceptionHandler\Business\Handler\ExceptionHandlerInterface;
use DockerCi\ExceptionHandler\Business\Printer\DebugPrinter;
use DockerCi\ExceptionHandler\Business\Printer\ExceptionPrinterInterface;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \DockerCi\ExceptionHandler\ExceptionHandlerConfig getConfig()
 */
class ExceptionHandlerFactory extends AbstractFactory
{
    /**
     * @return \DockerCi\ExceptionHandler\Business\Handler\DefaultExceptionHandler
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function createExceptionHandler(): ExceptionHandlerInterface
    {
        return new DefaultExceptionHandler(
            $this->createExceptionPrinter(),
            $this->getConfig()->shutdownIfError()
        );
    }

    /**
     * @return \DockerCi\ExceptionHandler\Business\Printer\DebugPrinter
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function createExceptionPrinter(): ExceptionPrinterInterface
    {
        return new DebugPrinter(
            $this->getConfig()->isDebug()
        );
    }
}