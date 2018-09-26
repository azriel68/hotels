<?php

require 'config.php';

require 'class/job1.class.php';
require 'class/hotel.class.php';

use Job1\Job1;

use PHPUnit\Framework\TestCase;


class Job1Test extends TestCase {

    public function testMakeDirectory() {

        $l = new Job1();
        $this->assertTrue($l->makeDirectory());

    }

    public function testLoader() {

        $job = new Job1();

        $xmlIterator = $job->getIterator('hotelAll0.xml');

        $this->assertInstanceOf(SimpleXMLIterator::class, $xmlIterator);

        $this->assertEquals(5287, $xmlIterator->count());

        $xmlIterator->rewind();
        $xmlIterator->next();

        $raw = $xmlIterator->getChildren();

        $hotel = new \Hotel\Hotel();
        $job->mapper($raw, $hotel, MAPPING);

        $this->assertEquals(5, $hotel->getDistribution()->BONOTEL);
        $this->assertEquals('New York-New York Hotel', (String)$raw->name);

        $this->assertTrue($hotel->getParking() );
        $this->assertTrue($hotel->getSpa());
    }

    public function testImage() {
        $o = new \Hotel\IntroductionMedia();
        $o->setFromURL('2989.jpg' ,'Test');

        $this->assertEquals(600, $o->getSize()->height);
        $this->assertEquals(377357, $o->getWeight()->value);

    }

    public function testGoodURL() {
        global $url;

        $l = new Job1();
        $xmlIterator = $l->getIterator($url);

        $this->assertInstanceOf(SimpleXMLIterator::class, $xmlIterator);

    }


}
