<?php

/**
 * This file is part of the NGSymfonyExtra package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyring and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace NG\SymfonyExtra\Collection;

/**
 * Base collection core
 */
class Collection implements CollectionInterface
{
    // Storage
    protected $_storage = array();

    /**
     * Construct
     */
    public function __construct($storage = NULL)
    {
        if ($storage === NULL) {
            return;
        }

        if (!is_array($storage) && !$storage instanceof \Iterator) {
            throw new \InvalidArgumentException('Storage must be iterable.');
        }

        foreach ($storage as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * Implements \Iterator
     */
    public function current()
    {
        return current($this->_storage);
    }

    /**
     * Implements \Iterator
     */
    public function next()
    {
        return next($this->_storage);
    }

    /**
     * Implements \Iterator
     */
    public function key()
    {
        return key($this->_storage);
    }

    /**
     * Implements \Iterator
     */
    public function valid()
    {
        return (bool) current($this->_storage);
    }

    /**
     * Implements \Iterator
     */
    public function rewind()
    {
        return reset($this->_storage);
    }

    /**
     * Implements \ArrayAccess
     */
    public function offsetExists($offset)
    {
        return isset($this->_storage[$offset]);
    }

    /**
     * Implements \ArrayAccess
     */
    public function offsetSet($offset, $value)
    {
        $this->_storage[$offset] = $value;
    }

    /**
     * Implements \ArrayAccess
     */
    public function offsetGet($offset)
    {
        return $this->_storage[$offset];
    }

    /**
     * Implements \ArrayAccess
     */
    public function offsetUnset($offset)
    {
        unset ($this->_storage[$offset]);
    }

    /**
     * Implements \Countable
     */
    public function count()
    {
        return count($this->_storage);
    }

    /**
     * Has offset
     *
     * @param string $offset
     *
     * @return boolean
     */
    public function has($offset)
    {
        return $this->offsetExists($offset);
    }

    /**
     * Remove element by offset
     *
     * @param string $offset
     */
    public function remove($offset)
    {
        $this->offsetUnset($offset);
    }

    /**
     * Get all elements
     *
     * @return array
     */
    public function all()
    {
        return $this->_storage;
    }

    /**
     * Get
     *
     * Alias: offsetGet
     */
    public function get($offset)
    {
        return $this->offsetGet($offset);
    }

    /**
     * Add
     *
     * @param string $offset
     * @param mixed $value
     */
    public function add($offset, $value)
    {
        return $this->offsetSet($offset, $value);
    }
}