<?php

namespace deit\stream;

/**
 * Seekable stream
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
interface Seekable {

	const SEEK_SET = SEEK_SET;
	const SEEK_CUR = SEEK_CUR;
	const SEEK_END = SEEK_END;

	/**
	 * Gets whether the stream is closed
	 * @return 	bool
	 */
	public function getOffset();
	
	/**
	 * Seeks to the position in the stream
	 * @param   int $offset
	 * @param   int $from
	 * @return  Seekable
	 */
	public function seek($offset, $from = self::SEEK_SET);
	
}