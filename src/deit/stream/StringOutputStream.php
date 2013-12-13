<?php

namespace deit\stream;

/**
 * String output stream
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
class StringOutputStream implements OutputStream {

	/**
	 * The data
	 * @var 	string
	 */
	private $data		= '';

	/**
	 * @inheritdoc
	 */
	public function write($bytes, $count = null) {
		
		if (!is_null($count) && $count <= strlen($bytes)) {
			$this->data .= substr($bytes, 0, $count);
		} else {
			$this->data .= $bytes;
		}
		
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function __toString() {
		return $this->data;
	}

}