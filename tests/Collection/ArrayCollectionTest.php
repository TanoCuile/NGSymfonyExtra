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
     * usort ArrayCollection sorting test
     */
    public function testArrayCollectionUsort ()
    {
        // Test usort
        $collection = new ArrayCollection(array(2, 1, 4, 3));

        $this->checkSortCallback($collection, 'usort');

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
    }

    /**
     * uasort ArrayCollection sorting test
     */
    public function testArrayCollectionUasort()
    {
        // Test uasort
        $collection = new ArrayCollection(array('key2' => 2, 'key1' => 1, 'key4' => 4, 'key3' => 3));

        $this->checkSortCallback($collection, 'uasort');

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

    /**
     * uksort ArrayCollection sorting test
     */
    public function testArrayCollectionUksort ()
    {
        // Test for uksort
        $testArray = new ArrayCollection(array(
            'some5' => 2,
            'some8' => 1,
            'some1' => 10,
            'some3' => 3
        ));

        $this->checkSortCallback($testArray, 'uksort');

        $status = $testArray->uksort(function($a, $b) {
            if ($a == $b) {
                return 0;
            }

            return $a < $b ? -1 : 1;
        });

        if ($status !== TRUE) {
            $this->fail('Sort uksort must return TRUE.');
        }

        $storage = $testArray->all();

        $trueValues = array(
            'some1' => 10,
            'some3' => 3,
            'some5' => 2,
            'some8' => 1
        );

        $storeKeys = array_keys($storage);
        $trueKeys = array_keys($trueValues);

        for ($i = 0; $i < 4; ++$i) {
            $this->assertEquals($storeKeys[$i], $trueKeys[$i]);
            $this->assertEquals($storage[$storeKeys[$i]], $trueValues[$trueKeys[$i]]);
        }
    }


    /**
     * ksort ArrayCollection sorting test
     */
    public function testArrayCollectionKsort ()
    {
        // Test for ksort
        $testArray = new ArrayCollection(array(
            'b' => 562,
            'a' => 892,
            'k' => 32,
            'R' => '7'
        ));

        $status = $testArray->ksort();

        if ($status !== TRUE) {
            $this->fail('Sort ksort must return TRUE.');
        }

        $trueValues = array(
            'R' => '7',
            'a' => 892,
            'b' => 562,
            'k' => 32,);

        $trueKeys = array_keys($trueValues);

        $storage = $testArray->all();

        $storeKeys = array_keys($storage);

        for ($i = 0; $i < 4; ++$i) {
            $this->assertEquals($storeKeys[$i], $trueKeys[$i]);
            $this->assertEquals($storage[$storeKeys[$i]], $trueValues[$trueKeys[$i]]);
        }
    }

    /**
     * krsort AssayCollection sorting test
     */
    public function testArrayCollectionKrsort ()
    {
        // Test for krsort
        $testArray = new ArrayCollection(array(
            'obj5' => 54,
            'obj1' => 32,
            'obj8' => 35,
            'obj2' => '7'
        ));

        $status = $testArray->krsort();

        if ($status !== TRUE) {
            $this->fail('Sort krsort must return TRUE.');
        }

        $trueValues = array(
            'obj1' => 32,
            'obj2' => '7',
            'obj5' => 54,
            'obj8' => 35,
        );

        $trueKeys = array_keys($trueValues);

        $storage = $testArray->all();

        $storeKeys = array_keys($storage);

        for ($i = 0; $i < 4; ++$i) {
            $this->assertEquals($storeKeys[$i], $trueKeys[3 - $i]);
            $this->assertEquals($storage[$storeKeys[$i]], $trueValues[$trueKeys[3 - $i]]);
        }
    }

    /**
     * Check callback for sorting
     *
     * @param ArrayCollectionInterface $object
     * @param string sortMethod
     */
    protected function checkSortCallback(ArrayCollectionInterface $object, $method)
    {
        try{
            $object->{$method}('someCallback');
            $this->fail(sprintf('Method %s do not controll callable method.', $method));
        }
        catch (\InvalidArgumentException $e) {
            return true;
        }
    }
}