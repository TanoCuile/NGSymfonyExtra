<?php

use Symfony\Component\Translation\Translator,
    Symfony\Component\Translation\Loader\ArrayLoader,
    NG\SymfonyExtra\Translation\JSTranslator,
    NG\SymfonyExtra\Translation\JSTranslatorInterface,
    NG\SymfonyExtra\Collection\Collection,
    NG\SymfonyExtra\Collection\CollectionInterface,
    NG\SymfonyExtra\Translation\Serializer\Serializer;

/**
 * Test for JSTranslator
 */
class JSTranslatorTest extends \PHPUnit_Framework_TestCase
{
  /**
   * Full JSTransaltor test
   */
  public function testJSTranslator()
  {
    // Add texts to symfony translator
    $symfonyTranslator = $this->createSymfonyTranslator();

    $jsTranslator = new JSTranslator($symfonyTranslator);
    $jsTranslator = new JSTranslator($symfonyTranslator, new Collection);

    $this->assertTrue($jsTranslator instanceof JSTranslatorInterface);

    $jsTranslator->add('hello.friend');
    $jsTranslator->add('hello.friend', 'messages', 'ru');
    $jsTranslator->add('hello.friend', 'foo', 'en');

    // Get messages bag
    $messagesBag = $jsTranslator->getMessagesBag();
    $this->assertTrue($messagesBag instanceof CollectionInterface);

    // Create a new serialized
    $serializer = new Serializer;
    $serializer
        ->setMessages($messagesBag);

    $jsonData = $serializer->jsonSerialize();

    $this->assertTrue(is_array($jsonData));
    $this->assertTrue(isset($jsonData['en']['trans']['messages']));
    $this->assertTrue(isset($jsonData['en']['trans']['messages']['hello.friend']));
    $this->assertTrue(isset($jsonData['ru']['trans']['messages']));
    $this->assertTrue(isset($jsonData['ru']['trans']['messages']['hello.friend']));
    $this->assertTrue(isset($jsonData['en']['trans']['foo']['hello.friend']));

    $this->assertEquals($jsonData['en']['trans']['messages']['hello.friend'], 'Hello friend %name');
  }

  /**
   * Create new symfony translator
   *
   * @return Translator
   */
  protected function createSymfonyTranslator()
  {
    $symfonyTranslator = new Translator('en');
    $symfonyTranslator->addLoader('array', new ArrayLoader());
    $symfonyTranslator->addResource('array', array('hello.friend' => 'Hello friend %name'), 'en');
    $symfonyTranslator->addResource('array', array('hello.friend' => 'Hello friend %name (Russian domain).'), 'ru');

    return $symfonyTranslator;
  }
}