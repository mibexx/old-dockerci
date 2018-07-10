<?php


namespace DockerCi\ExceptionHandler\Business\Printer;


interface ExceptionPrinterInterface
{
    /**
     * @param \Exception $exception
     */
    public function printExeption(\Exception $exception): void;
}