<?php
declare(strict_types=1);


namespace DockerCi\NodePhp\Business\Hydrator;


use DataProvider\NodeDataProvider;
use DataProvider\PhpConfigDataProvider;
use Xervice\YamlConfig\Business\Exception\ConfigException;

class PhpHydrator implements PhpHydratorInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var \DataProvider\NodeDataProvider
     */
    private $node;

    /**
     * PhpHydrator constructor.
     *
     * @param array $data
     * @param \DataProvider\NodeDataProvider $node
     */
    public function __construct(
        array $data,
        NodeDataProvider $node
    ) {
        $this->data = $data;
        $this->node = $node;
    }

    /**
     * @return \DataProvider\NodeDataProvider
     * @throws \Xervice\YamlConfig\Business\Exception\ConfigException
     */
    public function hydrate(): NodeDataProvider
    {
        $this->validateConfig();

        $phpConfig = new PhpConfigDataProvider();
        $phpConfig->setVersion((string) $this->data['version']);

        if (isset($this->data['extensions'])) {
            $phpConfig->setExtensions($this->data['extensions']);
        }

        if (isset($this->data['pecl'])) {
            $phpConfig->setPecl($this->data['pecl']);
        }

        $this->node->setPhp($phpConfig);
        return $this->node;
    }

    /**
     * @throws \Xervice\YamlConfig\Business\Exception\ConfigException
     */
    private function validateConfig(): void
    {
        if (!isset($this->data['version'])) {
            throw new ConfigException(
                sprintf(
                    'Node %s: PHP config has no field version',
                    $this->node->getName()
                )
            );
        }
    }


}