<?php

/**
 * This file is part of the NGSymfonyExtra package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyring and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace NG\SymfonyExtra\HttpFoundation;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * XmlResponse
 */
class XmlResponse extends SymfonyResponse
{
    /**
     * Construct
     *
     * @param \DOMDocument $xmlData
     * @param int $status
     * @param array $headers
     */
    public function __construct(\DOMDocument $xmlData, $status = 200, array $headers = array(), $formatOutput = TRUE)
    {
        if (!array_key_exists('Content-Type', $headers)) {
            $headers['Content-Type'] = 'text/xml';
        }

        $xmlData->formatOutput = $formatOutput;
        parent::__construct($xmlData->saveXML(), $status, $headers);
    }

}