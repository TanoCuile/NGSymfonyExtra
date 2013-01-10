<?php

/**
 * This file is part of the NGSymfonyExtensions package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyring and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace NG\SymfonyExtra\Translation\Serializer;

use NG\SymfonyExtra\Collection\CollectionInterface;

/**
 * Interface for control serializer
 */
interface SerializerInterface
{
  /**
   * Set messages
   *
   * @param CollectionInterface
   */
  public function setMessages(CollectionInterface $messagesCollection);

  /**
   * Json serialize
   *
   * @alias: JsonSerializable (Interface)
   */
  public function jsonSerialize();
}