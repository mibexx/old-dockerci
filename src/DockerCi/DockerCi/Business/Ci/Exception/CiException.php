<?php


namespace DockerCi\DockerCi\Business\Ci\Exception;


use DockerCi\StepEngine\Business\Exception\StepException;

class CiException extends StepException
{
    /**
     * CiException constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = '', int $code = 0, \Throwable $previous = null)
    {
        $message = sprintf(
            '[CI] %s',
            $message
        );

        parent::__construct($message, $code, $previous);
    }

}