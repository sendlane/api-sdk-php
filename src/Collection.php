<?php
/*
 * This file is part of the MerchantAPI package.
 *
 * (c) Miva Inc <https://www.miva.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MerchantAPI;

/**
 * Wraps a array of items in an object. Ideal for collections of objects.
 *
 * @package MerchantAPI
 */
class Collection implements \ArrayAccess, \Iterator, \Countable
{
    /** @var array */
    protected $container;

    /**
     * Collection constructor.
     *
     * @param array $container
     */
    public function __construct(array $container = [])
    {
        $this->container = $container;
    }

    /**
     * Clone.
     */
    public function __clone()
    {
        foreach ($this->container as $i => $e) {
            if (is_object($e)) {
                $this->container[$i] = clone $e;
            }
        }
    }

    /**
     * Set or update an entry.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->container[$key] = $value;
        return $this;
    }

    /**
     * Insert an entry at the end.
     *
     * @param $value
     * @return $this
     */
    public function insert($value)
    {
        $this->container[] = $value;
        return $this;
    }

    /**
     * Remove an entry by key.
     *
     * @param $key
     * @return $this
     */
    public function remove($key)
    {
        unset($this->container[$key]);
        return $this;
    }

    /**
     * Get the underlying container.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->container;
    }

    /**
     * Get the number of entries in the container.
     *
     * @return int
     */
    public function count()
    {
        return count($this->container);
    }

    /**
     * Get the first entry in the container.
     *
     * @return mixed
     */
    public function first()
    {
        return reset($this->container);
    }

    /**
     * Get the last entry in the container.
     *
     * @return mixed
     */
    public function last()
    {
        return end($this->container);
    }

    /**
     * Get the key of the current container.
     *
     * @return mixed
     */
    public function key()
    {
        return key($this->container);
    }

    /**
     * Get the next entry in the container.
     *
     * @return mixed
     */
    public function next()
    {
        return next($this->container);
    }

    /**
     * Check if the iterator can go forward to the next.
     *
     * @return bool
     */
    public function hasNext()
    {
        if ($this->next() !== false) {
            $this->previous();
            return true;
        }

        $this->last();
        return false;
    }

    /**
     * Get the previous entry in the container.
     *
     * @return mixed
     */
    public function previous()
    {
        return prev($this->container);
    }

    /**
     * Check if the iterator can go back to the previous.
     *
     * @return bool
     */
    public function hasPrevious()
    {
        $prev   = $this->previous();

        if ($prev || ($prev === false && $this->key() != null)) {
            $this->next();
            return true;
        }

        $this->first();
        return false;
    }

    /**
     * Get the current entry in the container.
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->container);
    }

    /**
     * Check if the current entry is valid.
     *
     * @return bool
     */
    public function valid()
    {
        return !is_null(key($this->container));
    }

    /**
     * Rewind the container iterator and return the first entry.
     *
     * @return mixed
     */
    public function rewind()
    {
        return $this->first();
    }

    /**
     * Check if an offset exists in the container.
     *
     * @param mixed
     * @return bool
     */
    public function offsetExists($offset)
    {
        return is_null($offset) ? false : isset($this->container[$offset]);
    }

    /**
     * Get the value in the container at specified offset.
     *
     * @param mixed
     * @return mixed
     */
    public function offsetGet($offset)
    {
        if (!is_null($offset) && isset($this->container[$offset])) {
            return $this->container[$offset];
        }

        return null;
    }

    /**
     * Set the value in the container at specified. offset.
     *
     * @param mixed
     * @param mixed
     * @return $this
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }

        return $this;
    }

    /**
     * Unset container at offset.
     *
     * @param mixed
     * @return $this
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
        return $this;
    }
}