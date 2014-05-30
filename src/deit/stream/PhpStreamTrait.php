<?php

namespace deit\stream;

/**
 * PHP stream base
 * @author    James Newell <james@digitaledgeit.com.au>
 */
trait PhpStreamTrait {

	/**
	 * The stream resource
	 * @var    resource
	 */
	protected $stream;

	/**
	 * Whether the stream should be closed when the class is destroyed
	 * @var    bool
	 */
	protected $closeOnDestruct;

	/**
	 * Constructs the output stream
	 * @param    resource $stream          The PHP stream resource
	 * @param    bool     $closeOnDestruct Whether the stream should be closed when the class is destroyed
	 * @throws  StreamException
	 */
	public function __construct($stream, $closeOnDestruct = true) {

		//check the resource type
		if (get_resource_type($stream) != 'stream') {
			throw new StreamException('Stream is an invalid resource');
		}

		$this->stream          = $stream;
		$this->closeOnDestruct = (bool)$closeOnDestruct;
	}

	/**
	 * Gets the native PHP stream
	 * @depreciated
	 * @return bool|resource
	 */
	public function getNativeStream() {
		return $this->stream;
	}

	/**
	 * Destroys the stream
	 */
	public function __destruct() {

		//close the stream
		if ($this->closeOnDestruct && !$this->isClosed()) {
			$this->close();
		}

	}

	/**
	 * Asserts that a stream is open
	 *
	 * @throws StreamException
	 */
	protected function assertIsNotClosed() {
		if ($this->isClosed()) {
			throw new ClosedException('Stream is closed');
		}
	}

}
