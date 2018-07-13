<?php
declare(strict_types=1);


namespace DockerCi\DockerCi\Business\Ci\Steps;


use DockerCi\DockerCi\Business\Ci\Exception\CiException;

/**
 * @method \DockerCi\DockerCi\DockerCiFactory getFactory()
 */
class PrepareWorkdir extends AbstractStep
{
    public function preCheck(): void
    {

    }

    /**
     * @throws \DockerCi\DockerCi\Business\Ci\Exception\CiException
     */
    public function postCheck(): void
    {
        if (!is_dir($this->getData()->getBuilddir())) {
            throw new CiException(
                sprintf(
                    'Build dir %s could not be created',
                    $this->getData()->getBuilddir()
                )
            );
        }
    }

    /**
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function execute(): void
    {
        if (!is_dir($this->getData()->getBuilddir())) {
            $this->getFactory()->getShellFacade()->runCommand(
                'mkdir -m 0777 -p %s',
                $this->getData()->getBuilddir()
            );
            $this->addMessage('Creating builddir', 'Prepare');
        }
    }

}