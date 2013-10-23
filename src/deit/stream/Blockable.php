<?php

namespace deit\stream;

/**
 * Blockable stream
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
interface Blockable {

	/**
	 * Gets whether the stream may block on read|write
	 * @return 	bool
	 */
	public function isBlocking();

	/**
	 * Sets whether the stream may block on read|write
	 * @param	bool $blocking
	 * @return 	Blockable
	 */
	public function setBlocking($blocking);

}