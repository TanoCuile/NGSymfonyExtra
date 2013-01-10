<?php

/**
 * This file is part of the NGSymfonyExtra package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyring and license information, please view the LICENSE
 * file that was distributed with this source code
 */

use NG\SymfonyExtra\Collection\Collection,
    NG\SymfonyExtra\Collection\CollectionInterface;


/**
 * Collection tests
 */
class CollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Base test collection
     */
    public function testBaseCollection()
    {
      $collection = new Collection;
      $this->assertTrue($collection instanceof CollectionInterface);
    }

    /**
     * Full collection text
     */
    public function testCollection()
    {
        // Create a new collection
        $collection = new Collection(array('key1' => 'value1'));

        // Validate as object
        $this->assertTrue($collection->has('key1'));
        $this->assertFalse($collection->has('key2'));
        $this->assertTrue($collection->get('key1') == 'value1');
        $this->assertFalse($collection->get('key1') == 'undefined');

        // Validate as array
        $this->assertTrue(isset($collection['key1']));
        $this->assertFalse(isset($collection['key2']));
        $this->assertTrue($collection['key1'] == 'value1');
        $this->assertFalse($collection['key1'] == 'undefined');

        // Add key to collection
        $collection->add('key2', 'value2');
        $collection->add('key3', array('mixed'));
        $collection->add('key4', new \stdClass);

        $collection->remove('key1');

        $this->assertFalse(isset($collection['key1']));
        $this->assertTrue($collection['key2'] == 'value2');

        unset ($collection['key2']);

        $this->assertFalse(isset($collection['key2']));

        $this->assertTrue($collection['key3'] === array('mixed'));
        $this->assertTrue(get_class($collection['key4']) == 'stdClass');
        $this->assertTrue(count($collection) == 2);

        unset ($collection['key4']);

        $this->assertTrue($collection->all() === array('key3' => array('mixed')));
    }
}