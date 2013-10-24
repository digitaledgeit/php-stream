<?php

namespace deit\stream;

/**
 * PHP output stream test
 * @author James Newell <james@digitaledgeit.com.au>
 */
class PhpOutputStreamTest extends \PHPUnit_Framework_TestCase {

	public function test_writeToInMemoryStream() {

		$stream = new PhpOutputStream(fopen('php://memory', 'w+'));

		$this->assertFalse($stream->isClosed());

		$stream->write('Hello');
		$stream->write(' World!');

		$fh = $stream->native();
		rewind($fh);
		$this->assertEquals('Hello World!', stream_get_contents($fh));

		$this->assertFalse($stream->isClosed());
		$stream->close();
		$this->assertTrue($stream->isClosed());

	}

}
 