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

use Symfony\Component\Translation\TranslatorInterface,
    NG\SymfonyExtra\Collection\CollectionInterface,
    NG\SymfonyExtra\Collection\Collection;

/**
 * Core for control JS translator
 */
class JSTranslator implements JSTranslatorInterface
{
    // Translator
    protected $translator = NULL;

    // Messages bag
    protected $messagesBag = NULL;

    /**
     * Construct
     *
     * @param TranslatorInterface $translator
     * @param CollectionInterface $messagesBag
     */
    public function __construct(TranslatorInterface $translator, CollectionInterface $messagesBag = NULL)
    {
        $this->translator = $translator;

        if ($messagesBag === NULL) {
            $messagesBag = new Collection;
        }

        $this->messagesBag = $messagesBag;
    }

    /**
     * @{inerhitDoc}
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * @{inerhitDoc}
     */
    public function getMessagesBag()
    {
        return $this->messagesBag;
    }

    /**
     * @{inerhitDoc}
     */
    public function add($id, $domain = 'messages', $locale = NULL)
    {
        if ($locale === NULL) {
            $locale = $this->translator->getLocale();

            if (!$locale) {
                throw new \InvalidArgumentException('Undefined locale');
            }
        }

        if (!is_string($id)) {
            throw new \InvalidArgumentException(sprintf('Message id must be a string, "%s" given.', gettype($id)));
        }

        if (!is_string($domain)) {
            throw new \InvalidArgumentException(sprintf('Message domain must be a string, "%s" given.', gettype($domain)));
        }

        $message = array(
            'id' => $id,
            'domain' => $domain,
            'locale' => $locale,
            'type' => 'trans',
            'trans' => $this->translator->trans($id, array(), $domain, $locale)
        );

        $this->messagesBag[$id . $locale . $domain] = $message;

        return $this;
    }
}