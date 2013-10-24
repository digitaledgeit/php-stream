<?php

namespace deit\stream;

/**
 * String input stream test
 * @author James Newell <james@digitaledgeit.com.au>
 */
class StringInputStreamTest extends \PHPUnit_Framework_TestCase {

	public function test_read() {

		$stream = new StringInputStream('Hello World!');

		$this->assertFalse($stream->end());
		$this->assertEquals('Hello', $stream->read(5));

		$this->assertFalse($stream->end());
		$this->assertEquals(' World!', $stream->read(25));

		$this->assertTrue($stream->end());
		$this->assertEquals('', $stream->read(1));

	}

}
 