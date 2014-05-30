<?php

namespace deit\stream;

/**
 * A file input stream
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
class FileInputStream extends PhpInputStream {

	/**
	 * Construct the stream
	 * @param string    $file
	 */
	public function __construct($file) {
		parent::__construct(fopen((string) $file, 'r'));
	}

}