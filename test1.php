<?php


require 'config.php';
require 'class/job1.class.php';

use Job1\Loader;

use PHPUnit\Framework\TestCase;


class ExceptionTest extends TestCase
{

    public function testMakeDirectory() {

        $l=new Loader();
        $this->assertTrue($l->makeDirectory());

    }

    public function testLoader() {
        $content = file_get_contents('hotelAll0.xml');
        $xmlIterator = new SimpleXMLIterator($content);

        $this->assertEquals(5287, $xmlIterator->count());

        $xmlIterator->rewind();
        $xmlIterator->next();

        $hotel = $xmlIterator->getChildren();

        $this->assertEquals('5', (String) $hotel->hotelCode );
        $this->assertEquals('New York-New York Hotel', (String) $hotel->name);

    }


}
