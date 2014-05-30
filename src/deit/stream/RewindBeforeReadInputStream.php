<?php

namespace deit\stream;

/**
 * Stream that rewinds to the last know position before the next read readyOperation
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
	 * Gets the inner stream
	 * @return  InputStream
	 */
	public function getInnerStream() {
		return $this->stream;
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

		//move to the position of the last read data
		$this->stream->seek($this->offset, Seekable::SEEK_SET);

		//read the data and update the offset
		$data = $this->stream->read($count);
		$this->offset += strlen($data);

		//if we didn't read to the end of the stream, then seek to the end of the stream so any data written to the stream
		//by another process won't write over un-read data
		if (!$this->stream->end()) {
			$this->stream->seek(0, Seekable::SEEK_END);
		}

		return $data;
	}

}