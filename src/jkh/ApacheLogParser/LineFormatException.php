<?php
namespace jkh\ApacheLogParser;


use Exception;

class LineFormatException extends Exception
{

    /**
     * LineFormatException constructor.
     * @param $line
     */
    public function __construct($line)
    {
    }
}