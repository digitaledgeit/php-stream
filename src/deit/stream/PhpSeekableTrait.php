<?php

namespace deit\stream;

/**
 * Seekable trait
 * @author James Newell <james@digitaledgeit.com.au>
 */
trait PhpSeekableTrait {

	/**
	 * @inheritdoc
	 */
	public function getOffset() {
		if (($offset = ftell($this->stream)) == false) {
			throw new StreamException('Unable to determine the current offset');
		}
		return $offset;
	}

	/**
	 * @inheritdoc
	 */
	public function seek($offset, $from = self::SEEK_SET) {
		if (fseek($this->stream, $offset, $from) != 0) {
			throw new StreamException('Unable to seek to the offset');
		};
	}

}
 