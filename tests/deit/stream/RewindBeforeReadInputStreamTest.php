<?php

namespace deit\stream;

/**
 * Rewind input stream test
 * @author James Newell <james@digitaledgeit.com.au>
 */
class RewindBeforeReadInputStreamTest extends \PHPUnit_Framework_TestCase {

	public function test() {

		$fh     = tmpfile();
		$pis    = new PhpInputStream($fh);
		$rbris  = new RewindBeforeReadInputStream($pis);

		fwrite($fh, "Hello World!\n");
		$this->assertEquals("Hello World!\n", $rbris->read(100));

		fwrite($fh, "Lorem Ipsum\n");
		fwrite($fh, "is very boring text!\n");
		$this->assertEquals("Lorem Ipsum\nis very boring text!\n", $rbris->read(100));
	
	}

} 