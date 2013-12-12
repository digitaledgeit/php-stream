<?php

namespace deit\stream;

/**
 * Input stream
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
interface InputStream {

	/**
	 * Gets whether a read operation has tried to read beyond the end of the stream
	 * @return 	bool
	 */
	public function end();

	/**
	 * Reads up to $count bytes from the stream
	 * @param 	int $count The maximum number of bytes to read from the stream
	 * @return 	string
	 * @throws 	StreamException If the stream can't be read
	 */
	public function read($count);
	
}