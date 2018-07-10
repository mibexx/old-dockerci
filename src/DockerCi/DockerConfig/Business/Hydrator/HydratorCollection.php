<?php


namespace DockerCi\DockerConfig\Business\Hydrator;


class HydratorCollection implements \Iterator, \Countable
{
    /**
     * @var \DockerCi\DockerConfig\Business\Hydrator\HydratorInterface[]
     */
    private $collection;

    /**
     * @var int
     */
    private $position;

    /**
     * Collection constructor.
     *
     * @param \DockerCi\DockerConfig\Business\Hydrator\HydratorInterface[] $collection
     */
    public function __construct(array $collection)
    {
        foreach ($collection as $validator) {
            $this->add($validator);
        }
    }

    /**
     * @param \DockerCi\DockerConfig\Business\Hydrator\HydratorInterface $validator
     */
    public function add(HydratorInterface $validator)
    {
        $this->collection[] = $validator;
    }

    /**
     * @return \DockerCi\DockerConfig\Business\Hydrator\HydratorInterface
     */
    public function current()
    {
        return $this->collection[$this->position];
    }

    public function next()
    {
        $this->position++;
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->collection[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return int
     */
    public function count()
    {
        return \count($this->collection);
    }
}