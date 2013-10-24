<?php

namespace deit\stream;

/**
 * String input stream
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
class StringInputStream implements InputStream {
	
	/**
	 * The position within the data
	 * @var     int
	 */
	private $pos 		= 0;
	
	/**
	 * The length of the data
	 * @var 	int
	 */
	private $length		= 0;
	
	/**
	 * The data
	 * @var 	string
	 */
	private $data		= '';
	
	/**
	 * Constructs the input stream
	 * @param 	string $data
	 */
	public function __construct($data) {
		$this->data 	= (string) $data;
		$this->length 	= strlen($this->data);
	}

	/**
	 * @inheritdoc
	 */
	public function end() {
		return $this->pos >= $this->length;
	}

	/**
	 * @inheritdoc
	 */
	public function read($length) {

		if ((int) $length < strlen($this->data)-$this->pos) {
			$data = substr($this->data, $this->pos, $length);
			$this->pos += $length;
		} else {
			$data = substr($this->data, $this->pos);
			$this->pos = strlen($this->data);
		}

		return $data;	
	}

	/**
	 * @inheritdoc
	 */
	public function __toString() {
		return $this->data;
	}

}