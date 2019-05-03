<?php

namespace jkh\Tests\ApacheLogParser;

use jkh\ApacheLogParser\ApacheLogParser;
use jkh\ApacheLogParser\LineFormatException;
use PHPUnit\Framework\TestCase;

class ApacheLogParserTest extends TestCase
{
    public function testIsMemberOfStandardClassEntry()
    {
        $parser = new ApacheLogParser('%h %l %u %t "%r" %>s %b');
        $entry = $parser->parse('127.0.0.1 - frank [10/Oct/2000:13:55:36 -0700] "GET /apache_pb.gif HTTP/1.0" 200 2326');
        $this->assertInstanceOf("\stdClass", $entry);
    }

    public function testCombinedFormat()
    {
        $parser = new ApacheLogParser('%h %l %u %t "%r" %>s %O');
        $entry = $parser->parse('127.0.0.1 - frank [10/Oct/2000:13:55:36 -0700] "GET /apache_pb.gif HTTP/1.0" 200 2326');

        $this->assertEquals('127.0.0.1', $entry->host);
        $this->assertEquals('-', $entry->logname);
        $this->assertEquals('frank', $entry->user);
        $this->assertEquals('10/Oct/2000:13:55:36 -0700', $entry->time);
        $this->assertEquals('GET /apache_pb.gif HTTP/1.0', $entry->request);
        $this->assertEquals('200', $entry->status);
        $this->assertEquals('2326', $entry->sentBytes);
    }

    public function testExceptionInCreateEntry()
    {
        $parser = new ApacheLogParser('"%r" %h %l %u %t  %>s %O');
        $this->expectException(LineFormatException::class);
        $parser->parse('127.0.0.1 - frank [10/Oct/2000:13:55:36 -0700] "GET /apache_pb.gif HTTP/1.0" 200 2326');
    }
}