<?php

namespace deit\stream;

/**
 * Closable trait
 * @author James Newell <james@digitaledgeit.com.au>
 */
trait PhpCloseableTrait {

	/**
	 * @inheritdoc
	 */
	public function isClosed() {
		return $this->stream === false;
	}

	/**
	 * @inheritdoc
	 */
	public function close() {

		//make sure the stream is open
		$this->assertIsNotClosed();

		//closes stream
		if (fclose($this->stream) === false) {
			throw new StreamException('Unable to close stream.');
		}

		$this->stream = false;

		return $this;
	}

}
 