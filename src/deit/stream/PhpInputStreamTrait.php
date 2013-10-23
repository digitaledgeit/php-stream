<?php

namespace deit\stream;

/**
 * A PHP input stream opened by fopen, fsockopen or pfsockopen
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
trait PhpInputStreamTrait {

	/**
	 * @inheritdoc
	 */
	public function end() {
		$this->assertIsNotClosed();
		return feof($this->stream);
	}

	/**
	 * Reads up to $count bytes from the stream
	 *
	 * If blocking is enabled on the stream, reading returns when:
	 *  - $count bytes have been read
	 *  - the end of stream has been reached
	 *  - a packet comes available or a timeout occurs
	 *
	 * If blocking is not enabled on the stream, reading immediately returns the amount of bytes in the buffer.
	 *
	 * @param   int $count The maximum number of bytes to read from the stream
	 * @return  string
	 * @throws 	StreamException If the stream can't be read
	 * @throws  ClosedException If the stream is closed
	 */
	public function read($count) {
		$this->assertIsNotClosed();

		//read from the stream
		if (($bytes = fread($this->stream, $count)) === false) {
			throw new StreamException('Unable to read from stream.');
		}
		
		return $bytes;
	}
	
}