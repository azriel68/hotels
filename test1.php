<?php

require 'config.php';

require 'class/job1.class.php';

use Job1\Job1;

use PHPUnit\Framework\TestCase;


class Job1Test extends TestCase
{

    public function testMakeDirectory() {

        $l=new Job1();
        $this->assertTrue($l->makeDirectory());

    }

    public function testLoader() {

        $l=new Job1();

        $xmlIterator = $l->getIterator('hotelAll0.xml' );

        $this->assertInstanceOf(SimpleXMLIterator::class, $xmlIterator);

        $this->assertEquals(5287, $xmlIterator->count());

        $xmlIterator->rewind();
        $xmlIterator->next();

        $hotel = $xmlIterator->getChildren();

        $this->assertEquals('5', (String) $hotel->hotelCode );
        $this->assertEquals('New York-New York Hotel', (String) $hotel->name);

    }

public function testGoodURL() {
        global $url;

    $l=new Job1();
    $xmlIterator = $l->getIterator($url);

    $this->assertInstanceOf(SimpleXMLIterator::class, $xmlIterator);

}


}
