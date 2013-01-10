<?php

/**
 * This file is part of the NGSymfonyExtra package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyring and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace NG\SymfonyExtra\Translation\Serializer;

use NG\SymfonyExtra\Collection\CollectionInterface;

/**
 * Core for serialize message collections
 */
class Serializer implements SerializerInterface
{
    // Messages collection
    protected $messagesCollection = NULL;

    /**
     * @{inerhitDoc}
     */
    public function setMessages(CollectionInterface $messagesCollection = NULL)
    {
        $this->messagesCollection = $messagesCollection;
    }

    /**
     * @{inerhitDoc}
     */
    public function jsonSerialize()
    {
        if (!$this->messagesCollection) {
            throw new \LogicException('Can\'t serialize messages. Messages not found.');
        }

        return $this->generate($this->messagesCollection);
    }

    /**
     * Generate translations array
     *
     * @param CollectionInterface $messageCollection
     */
    protected function generate(CollectionInterface $messageCollection)
    {
        $jsonData = array();

        foreach ($messageCollection as $messageId => $message) {
            $jsonData[$message['locale']][$message['type']][$message['domain']][$message['id']] = $message['trans'];
        }

        return $jsonData;
    }
}