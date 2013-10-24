<?php

namespace deit\stream;

/**
 * PHP output stream test
 * @author James Newell <james@digitaledgeit.com.au>
 */
class StringOutputStreamTest extends \PHPUnit_Framework_TestCase {

	public function test_write() {

		$stream = new StringOutputStream();

		$stream->write('Hello');
		$stream->write(' World!');

		$this->assertEquals('Hello World!', (string) $stream);

	}

}
 