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
 * Array collection
 *  add array functions
 */
class ArrayCollection extends Collection implements ArrayCollectionInterface
{
    // Storage
    protected $_storage = array();

    /**
     * @{inerhitDoc}
     */
    public function pop()
    {
        return array_pop($this->_storage);
    }

    /**
     * @{inerhitDoc}
     */
    public function shift()
    {
        return array_shift($this->_storage);
    }

    /**
     * @{inerhitDoc}
     */
    public function unshift()
    {
        foreach (array_reverse(func_get_args()) as $arg) {
            array_unshift($this->_storage, $arg);
        }

        return count($this->_storage);
    }

    /**
     * @{inerhitDoc}
     */
    public function push()
    {
        foreach (func_get_args() as $arg) {
            array_push($this->_storage, $arg);
        }

        return count($this->_storage);
    }

    /**
     * @{inerhitDoc}
     */
    public function uasort($callback)
    {
        if (!is_callable($callback)) {
            throw new \InvalidArgumentException('Callback must be a callable.');
        }

        return uasort($this->_storage, $callback);
    }

    /**
     * @{inerhitDoc}
     */
    public function usort($callback)
    {
        if (!is_callable($callback)) {
            throw new \InvalidArgumentException('Callback must be a callable.');
        }

        return usort($this->_storage, $callback);
    }
}