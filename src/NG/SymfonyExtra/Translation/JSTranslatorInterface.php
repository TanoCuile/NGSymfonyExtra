<?php

/**
 * This file is part of the NGSymfonyExtra package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyring and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace NG\SymfonyExtra\Translation;

/**
 * Interface for control javascript translator
 */
interface JSTranslatorInterface
{
    /**
     * Get default translator
     *
     * @return TranslatorInterface
     */
    public function getTranslator();

    /**
     * Get messages bag
     *
     * @return CollectionInterface
     */
    public function getMessagesBag();

    /**
     * Trans message for added to collection
     *
     * @param string $id
     * @param string $domain
     * @param string $locale
     */
    public function add($id, $domain = 'messages', $locale = NULL);
}