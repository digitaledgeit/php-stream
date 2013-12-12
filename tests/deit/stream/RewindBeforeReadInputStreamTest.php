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

	public function test_readOnlySome() {

		$fh     = tmpfile();
		$pis    = new PhpInputStream($fh);
		$rbris  = new RewindBeforeReadInputStream($pis);

		fwrite($fh, "Hello World!\n");
		$this->assertEquals("Hello", $rbris->read(5));

		fwrite($fh, "Lorem Ipsum\n");
		$this->assertEquals(" World!\nLorem Ipsum\n", $rbris->read(100));

	}

	public function test_end() {

		$fh     = tmpfile();
		$pis    = new PhpInputStream($fh);
		$rbris  = new RewindBeforeReadInputStream($pis);

		$i = 1;
		fwrite($fh, "Line $i");
		while (!$rbris->end()) {

			$line = $rbris->read(6);

			if (!empty($line)) { //expect an empty string the last time (feof doesn't trigger until you try and read past the end)
				$this->assertEquals("Line $i", $line);
			}

			++$i;

			if ($i < 9) {
				fwrite($fh, "Line $i");
			}

		}

	}

} 