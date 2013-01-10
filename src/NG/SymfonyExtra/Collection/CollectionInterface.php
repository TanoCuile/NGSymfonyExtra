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
 * Interface for control collections
 */
interface CollectionInterface extends \Iterator, \ArrayAccess, \Countable
{
    /**
     * Has
     *
     * @param string $offset
     */
    public function has($offset);

    /**
     * Remove
     *
     * @param string $offset
     */
    public function remove($offset);

    /**
     * Get all
     *
     * @return array
     */
    public function all();

    /**
     * Get
     *
     * @param string $offset
     */
    public function get($offset);
}