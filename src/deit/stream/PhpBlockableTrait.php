<?php

namespace deit\stream;

/**
 * Blockable trait
 * @author James Newell <james@digitaledgeit.com.au>
 */
trait PhpBlockableTrait {

	/**
	 * Whether the stream may block on read|write
	 * @var 	bool
	 */
	protected $blocking = true;

	/**
	 * @inheritdoc
	 */
	public function isBlocking() {
		return $this->blocking;
	}

	/**
	 * @inheritdoc
	 */
	public function setBlocking($mode) {

		//make sure the stream is open
		$this->assertIsNotClosed();

		//sets the blocking mode
		if (stream_set_blocking($this->stream, (bool) $mode ? 1 : 0) === false) {
			throw new StreamException('Unable to change blocking mode');
		}
		$this->blocking = (bool) $mode;

		return $this;
	}

}
 