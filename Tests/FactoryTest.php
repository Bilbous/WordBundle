<?php

namespace Bilbous\WordBundle\Tests;

use Bilbous\WordBundle\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $factory =  new Factory();
        $this->assertInstanceOf('\PhpOffice\PhpWord\PHPWord', $factory->createPHPWordObject());
    }

    public function testCreateStreamedResponse()
    {
        $writer = $this->getMock('\PhpOffice\PhpWord\Writer\Word2007');
        $writer->expects($this->once())
            ->method('save')
            ->with('php://output');

        $factory =  new Factory();
        $factory->createStreamedResponse($writer)->sendContent();
    }
}
