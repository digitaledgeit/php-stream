<?php

namespace deit\stream;

/**
 * Stream watcher
 * @author James Newell <james@digitaledgeit.com.au>
 */
class StreamWatcher {

	const OP_READ       = 1;
	const OP_WRITE      = 2;
	const OP_CONNECT    = 4;
	const OP_ACCEPT     = 8;

	/**
	 * The stream statueses
	 * @var     StreamWatcherStatus[]
	 */
	private $statuses = [];

	/**
	 * The number of fields we're watching
	 * @return  int
	 */
	public function count() {
		return count($this->statuses);
	}

	/**
	 * Starts watching a stream
	 * @param   InputStream|OutputStream    $stream
	 * @param   int                         $operation
	 * @param   mixed                       $context
	 * @return  $this
	 */
	public function register($stream, $operation, $context = null) {
		$this->statuses[] = new StreamWatcherStatus($stream, $operation, $context);
		return $this;
	}

	/**
	 * Stops watching a stream
	 * @param   InputStream|OutputStream    $stream
	 * @param   int                         $operation
	 * @return  $this
	 */
	public function unregister($stream, $operation = 0) {

	}

	/**
	 * Removes the stream
	 * @param   StreamWatcherStatus $status
	 * @return  $this
	 */
	public function remove(StreamWatcherStatus $status) {
		if (($i = array_search($status, $this->statuses, true)) !== false) {
			unset($this->statuses[$i]);
		}
		return $this;
	}

	/**
	 * Watches the streams for changes
	 * @param   float|null                  $timeout            Block for the specified amount of seconds
	 * @return  StreamWatcherStatus[]
	 * @throws  \RuntimeException
	 */
	public function watch($timeout = null) {

		if (is_null($timeout)) {
			$sec    = null;
			$usec   = null;
		} else {
			$sec    = floor($timeout);
			$usec   = ($timeout - $sec)*1000000;
		}

		$ready                  = [];
		$readyToReadStreams     = [];
		$readyToWriteStreams    = [];
		$readyToExceptStreams   = [];

		//create an array of streams to watch for each readyOperation
		foreach ($this->statuses as $status) {

			//streams to watch for reading
			if ($status->getWatchOperations() & self::OP_READ) {
				$readyToReadStreams[] = $status->getNativeStream();
			}

			//streams to watch for writing
			if ($status->getWatchOperations() & self::OP_WRITE) {
				$readyToWriteStreams[] = $status->getNativeStream();
			}

		}

		//wait for the streams to be ready
		if (($changed = stream_select($readyToReadStreams, $readyToWriteStreams , $readyToExceptStreams , $sec, $usec)) !== false) {

			foreach ($this->statuses as $status) {
				$operations = 0;

				//check if the stream is ready for reading
				foreach ($readyToReadStreams as $readyToReadStream) {
					if ($status->getNativeStream() === $readyToReadStream) {
						$operations = $operations | self::OP_READ;
						break;
					}
				}

				//check if the stream is ready for writing
				foreach ($readyToWriteStreams as $readyToWriteStream) {
					if ($status->getNativeStream() === $readyToWriteStream) {
						$operations = $operations | self::OP_WRITE;
						break;
					}
				}

				//check if the stream is ready for ...
				foreach ($readyToExceptStreams as $readyToExceptStream) {
					if ($status->getNativeStream() === $readyToExceptStream) {
						$operations = $operations;
						break;
					}
				}

				//set the ready operations
				if ($operations !== 0) {
					$status->setReadyOperations($operations);
					$ready[] = $status;
				}

			}

		} else {
			throw new \RuntimeException('An error occurred whilst watching streams.');
		}

		return $ready;
	}

}
 