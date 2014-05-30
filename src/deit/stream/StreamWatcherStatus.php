<?php

namespace deit\stream;

/**
 * Selector key
 * @author James Newell <james@digitaledgeit.com.au>
 */
class StreamWatcherStatus {

	/**
	 * The stream to watch
	 * @var     InputStream|OutputStream
	 */
	private $stream;

	/**
	 * The operations to watch for
	 * @var     int
	 */
	private $watchOperations;

	/**
	 * The operations observed
	 * @var     int
	 */
	private $readyOperations;

	/**
	 * The context
	 * @var     mixed|null
	 */
	private $context;

	/**
	 * Construct the stream
	 * @param   InputStream|OutputStream    $stream         The stream to watch
	 * @param   int                         $operations     The operations to watch for
	 * @param   mixed|null                  $context        Some context
	 */
	public function __construct($stream, $operations, $context = null) {
		$this->stream           = $stream;
		$this->setWatchOperations($operations);
		$this->setReadyOperations(0);
		$this->context          = $context;
	}

	/**
	 * Get the stream
	 * @return  InputStream|OutputStream
	 */
	public function getStream() {
		return $this->stream;
	}

	/**
	 * Get the operations to watch
	 * @return  int
	 */
	public function getWatchOperations() {
		return $this->watchOperations;
	}

	/**
	 * Set the operations to watch
	 * @param   int     $operations
	 * @return  $this
	 */
	public function setWatchOperations($operations) {
		$this->watchOperations = (int) $operations;
		return $this;
	}

	/**
	 * Get the ready operations
	 * @return  int
	 */
	public function getReadyOperations() {
		return $this->readyOperations;
	}

	/**
	 * Set the ready operations
	 * @param   int     $operations
	 * @return  $this
	 */
	public function setReadyOperations($operations) {
		$this->readyOperations = (int) $operations;
		return $this;
	}

	/**
	 * Get whether the stream is ready to connect
	 * @return  bool
	 */
	public function isConnectable() {
		return $this->readyOperations & StreamWatcher::OP_CONNECT;
	}

	/**
	 * Get whether the stream is ready to accept
	 * @return  bool
	 */
	public function isAcceptable() {
		return $this->readyOperations & StreamWatcher::OP_ACCEPT;
	}

	/**
	 * Get whether the stream is ready for reading
	 * @return  bool
	 */
	public function isReadable() {
		return $this->readyOperations & StreamWatcher::OP_READ;
	}

	/**
	 * Get whether the stream is ready for writing
	 * @return  bool
	 */
	public function isWritable() {
		return $this->readyOperations & StreamWatcher::OP_WRITE;
	}

	/**
	 * Get the native stream
	 * @return  resource
	 */
	public function getNativeStream() {
		$stream = $this->stream;
		while (method_exists($stream, 'getInnerStream')) {
			$stream = $stream->getInnerStream();
		}
		return $stream->getNativeStream();
	}

}
 