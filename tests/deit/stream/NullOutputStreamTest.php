<?php

namespace deit\stream;

/**
 * Null output stream test
 * @author James Newell <james@digitaledgeit.com.au>
 */
class NullOutputStreamTest extends \PHPUnit_Framework_TestCase {

	public function test_writeToInMemoryStream() {

		$stream = new NullOutputStream();

		$stream->write('Hello');
		$stream->write(' World!');

	}

}
 