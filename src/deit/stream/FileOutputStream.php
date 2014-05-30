<?php

namespace deit\stream;

/**
 * A file output stream
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
class FileOutputStream extends PhpOutputStream {

	/**
	 * Construct the stream
	 * @param   string    $file
	 * @param   string    $mode
	 * @throws  \InvalidArgumentException
	 */
	public function __construct($file, $mode = 'w') {

		if (!in_array($mode, ['w', 'a', 'x', 'c'], true)) {
			throw new \InvalidArgumentException("Invalid mode \"$mode\".");
		}

		parent::__construct(fopen((string) $file, $mode));
	}

}