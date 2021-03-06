<?php

namespace Rybakit\Bundle\NavigationBundle\Tests\Navigation\Iterator;

use Rybakit\Bundle\NavigationBundle\Navigation\Iterator\RecursiveCustomFilterIterator;

class RecursiveCustomFilterIteratorTest extends \PHPUnit_Framework_TestCase
{
    public function testAccept()
    {
        $iterator = new \RecursiveArrayIterator(array(1, array(21, 22), 3));

        $result = null;
        $iterator = new RecursiveCustomFilterIterator($iterator, function ($item) use (&$result) {
            $result = $item;
            return true;
        });

        foreach (new \RecursiveIteratorIterator($iterator) as $item) {
            $this->assertEquals($item, $result);
        }
    }

    public function testHasChildren()
    {
        $iterator = new \RecursiveArrayIterator(array(array(11, 12)));

        $withChildren = new RecursiveCustomFilterIterator($iterator, function ($item) { return true; });
        $withoutChildren = new RecursiveCustomFilterIterator($iterator, function ($item) { return false; });

        $this->assertTrue($withChildren->hasChildren());
        $this->assertFalse($withoutChildren->hasChildren());
    }
}
