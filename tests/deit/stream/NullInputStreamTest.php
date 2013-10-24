<?php

namespace deit\stream;

/**
 * Null input stream test
 * @author James Newell <james@digitaledgeit.com.au>
 */
class NullInputStreamTest extends \PHPUnit_Framework_TestCase {

	public function test_readFromInMemoryStream() {

		$stream = new NullInputStream();

		$this->assertTrue($stream->end());
		$this->assertEquals('', $stream->read(5));

		$this->assertTrue($stream->end());
		$this->assertEquals('', $stream->read(25));

	}

}
 