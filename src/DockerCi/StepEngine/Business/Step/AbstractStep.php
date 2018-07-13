<?php
declare(strict_types=1);


namespace DockerCi\StepEngine\Business\Step;


use DockerCi\StepEngine\Business\Exception\StepException;
use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\DataProvider\DataProvider\DataProviderInterface;

abstract class AbstractStep extends AbstractWithLocator implements StepInterface
{
    /**
     * @var DataProviderInterface
     */
    protected $dataProvider;

    /**
     * @return bool
     */
    public function isNeeded(): bool
    {
        try {
            $this->postCheck();
        } catch (StepException $exception) {
            return true;
        }

        return false;
    }

    /**
     * @param \Xervice\DataProvider\DataProvider\DataProviderInterface $dataProvider
     */
    public function setData(DataProviderInterface $dataProvider): void
    {
        $this->dataProvider = $dataProvider;
    }

}