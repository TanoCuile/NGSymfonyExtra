<?php

/**
 * This file is part of the NGSymfonyExtra package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyring and license information, please view the LICENSE
 * file that was distributed with this source code
 */

use NG\SymfonyExtra\Collection\ArrayCollection,
    NG\SymfonyExtra\Collection\ArrayCollectionInterface;

/**
 * Array collection tests
 */
class ArrayCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Base test collection
     */
    public function testBaseCollection()
    {
        $collection = new ArrayCollection;
        $this->assertTrue($collection instanceof ArrayCollectionInterface);
    }

    /**
     * Full test array collection
     */
    public function testCollection()
    {
        // Create a new collection
        $collection = new ArrayCollection(array('key1' => 'value1'));

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

        // Push elements
        $collection->push('v1', 'v2');

        $this->assertTrue(count($collection) == 3);
        $this->assertTrue(isset($collection[1]));

        // Pop
        $last = $collection->pop();
        $this->assertTrue($last === 'v2');

        // Unshift
        $count = $collection->unshift('u1', 'u2');
        $this->assertTrue($count == 4);
        $this->assertTrue(count($collection) == 4);

        $this->assertTrue($collection[0] == 'u1');

        // Shift
        $first = $collection->shift();
        $this->assertTrue($first == 'u1');
        $this->assertTrue(count($collection) == 3);
    }

    /**
     * Test sorting
     */
    public function testCollectionSorting()
    {
        // Test usort
        $collection = new ArrayCollection(array(2, 1, 4, 3));

        $collection->usort(function($a, $b) {
            if ($a == $b) {
                return 0;
            }

            return $a < $b ? -1 : 1;
        });

        $first = $collection->shift();
        $this->assertEquals($first, 1);

        $last = $collection->pop();
        $this->assertEquals($last, 4);

        // Test uasort
        $collection = new ArrayCollection(array('key2' => 2, 'key1' => 1, 'key4' => 4, 'key3' => 3));

        $collection->uasort(function($a, $b) {
            if ($a == $b) {
                return 0;
            }

            return $a < $b ? -1 : 1;
        });

        $storage = $collection->all();

        list ($firstKey, $firstValue) = each ($storage);

        $this->assertEquals($firstKey, 'key1');
        $this->assertEquals($firstValue, 1);

        for ($i = 1; $i <= 3; $i++) {
            list ($lastKey, $lastValue) = each ($storage);
        }

        $this->assertEquals($lastKey, 'key4');
        $this->assertEquals($lastValue, 4);
    }
}