<?php

namespace deit\stream;

/**
 * Stream that rewinds to the last know position before the next read operation
 * @author    James Newell <james@digitaledgeit.com.au>
 */
class RewindBeforeReadInputStream implements InputStream {

	/**
	 * The stream
	 * @var     InputStream
	 */
	private $stream;

	/**
	 * The stream offset
	 * @var     int
	 */
	private $offset;

	/**
	 * Constructs the stream
	 * @param   InputStream     $stream
	 * @throws
	 */
	public function __construct(InputStream $stream) {

		if (!$stream instanceof Seekable) {
			throw new \InvalidArgumentException('Stream must be seekable.');
		}

		$this->stream = $stream;
		$this->offset = 0;
	}

	/**
	 * @inheritdoc
	 */
	public function end() {
		return $this->stream->end();
	}

	/**
	 * @inheritdoc
	 */
	public function read($count) {
		$this->stream->seek($this->offset);
		$data = $this->stream->read($count);
		$this->offset += strlen($data);
		return $data;
	}

}