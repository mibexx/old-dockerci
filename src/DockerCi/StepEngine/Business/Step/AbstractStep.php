<?php
declare(strict_types=1);


namespace DockerCi\StepEngine\Business\Step;


use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\DataProvider\DataProvider\AbstractDataProvider;

abstract class AbstractStep extends AbstractWithLocator implements StepInterface
{
    /**
     * @var AbstractDataProvider
     */
    protected $dataProvider;

    /**
     * @param \Xervice\DataProvider\DataProvider\AbstractDataProvider $dataProvider
     */
    public function setData(AbstractDataProvider $dataProvider): void
    {
        $this->dataProvider = $dataProvider;
    }

}