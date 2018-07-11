<?php


namespace DockerCi\Shell\Business\Executor;


class ExecExecutor implements ExecutorInterface
{
    /**
     * @param $command
     *
     * @return string
     */
    public function execute($command): string
    {
        exec($command, $output);

        return implode(PHP_EOL, $output);
    }

}