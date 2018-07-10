<?php


namespace DockerCi\ExceptionHandler\Business\Handler;


interface ExceptionHandlerInterface
{
    /**
     * @param \Exception $exception
     */
    public function handleException(\Exception $exception): void;
}