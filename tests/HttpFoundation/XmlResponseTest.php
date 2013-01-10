<?php

/**
 * This file is part of the NGSymfonyExtra package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyring and license information, please view the LICENSE
 * file that was distributed with this source code
 */

use NG\SymfonyExtra\HttpFoundation\XmlResponse,
    Symfony\Component\HttpFoundation\Response;

/**
 * Xml response test
 */
class XmlResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test response class
     */
    public function testXmlResponse()
    {
        $newDom = new \DOMDocument();
        $newDom->loadXML('<rootNode />');
        $xmlResponse = new XmlResponse($newDom);

        // Validate response
        $this->assertTrue($xmlResponse instanceof Response);

        // Get headers
        $headers = $xmlResponse->headers;
        $this->assertTrue(in_array($headers->get('Content-Type'), array('text/xml')));
        $this->assertTrue($xmlResponse->isOk());

        $this->assertTrue($xmlResponse->getContent() == $newDom->saveXML());
    }
}