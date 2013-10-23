<?php

namespace deit\stream;

/**
 * Closeable stream
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
interface Closeable {
	
	/**
	 * Gets whether the stream is closed
	 * @return 	bool
	 */
	public function isClosed();
	
	/**
	 * Closes the stream
	 */
	public function close();
	
}