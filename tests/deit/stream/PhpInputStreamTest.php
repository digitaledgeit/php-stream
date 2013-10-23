<?php

namespace deit\stream;

/**
 * PHP input stream test
 * @author James Newell <james@digitaledgeit.com.au>
 */
class PhpInputStreamTest extends \PHPUnit_Framework_TestCase {

	public function test_readFromInMemoryStream() {

		//create the stream and fill it with some data
		$fh = fopen('php://memory', 'w+');
		fwrite($fh, 'Hello World!');
		rewind($fh);

		$stream = new \deit\stream\PhpInputStream($fh);

		$this->assertFalse($stream->isClosed());
		$this->assertFalse($stream->end());
		$this->assertEquals('Hello', $stream->read(5));
		$this->assertFalse($stream->end());
		$this->assertEquals(' World!', $stream->read(25));
		$this->assertTrue($stream->end());

		$this->assertFalse($stream->isClosed());
		$stream->close();
		$this->assertTrue($stream->isClosed());

	}

}
 