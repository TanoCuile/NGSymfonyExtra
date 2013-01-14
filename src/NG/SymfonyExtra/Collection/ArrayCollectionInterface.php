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
 * Interface for control ArrayCollection
 */
interface ArrayCollectionInterface extends CollectionInterface
{
    /**
     * @alias: array_pop
     */
    public function pop();

    /**
     * @alias: array_shift
     */
    public function shift();

    /**
     * @alias: array_unshift
     */
    public function unshift();

    /**
     * @alias: array_push
     */
    public function push();

    /**
     * @alias: uasort
     */
    public function uasort($callback);

    /**
     * @alias: usort
     */
    public function usort($callback);
}