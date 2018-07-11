<?php


namespace DockerCi\Nodes\Business\Hydrator\Collector;


class NodeHydratorCollection implements \Iterator, \Countable
{
    /**
     * @var \DockerCi\Nodes\Business\Hydrator\Collector\NodeHydratorInterface[]
     */
    private $collection;

    /**
     * @var int
     */
    private $position;

    /**
     * Collection constructor.
     *
     * @param \DockerCi\Nodes\Business\Hydrator\Collector\NodeHydratorInterface[] $collection
     */
    public function __construct(array $collection)
    {
        foreach ($collection as $validator) {
            $this->add($validator);
        }
    }

    /**
     * @param \DockerCi\Nodes\Business\Hydrator\Collector\NodeHydratorInterface $validator
     */
    public function add(NodeHydratorInterface $validator): void
    {
        $this->collection[] = $validator;
    }

    /**
     * @return \DockerCi\Nodes\Business\Hydrator\Collector\NodeHydratorInterface
     */
    public function current(): NodeHydratorInterface
    {
        return $this->collection[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->collection[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return \count($this->collection);
    }
}