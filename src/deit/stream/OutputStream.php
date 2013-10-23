<?php

namespace deit\stream;

/**
 * Output stream
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
interface OutputStream {

	/**
	 * Writes up to $count bytes to the stream
	 *
	 * @param 	string $bytes The bytes to write to the stream
	 * @param 	int|null $count The maximum number of bytes to write to the stream
	 * @return  OutputStream
	 * @throws  StreamException If the data can't be written to the stream
	 * @throws  StreamException If the end of the stream has been reached
	 */
	public function write($bytes, $count = null);
	
}