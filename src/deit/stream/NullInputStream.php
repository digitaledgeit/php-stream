<?php

namespace deit\stream;

/**
 * A null stream - a zero length stream with no contents
 * @author James Newell <james@digitaledgeit.com.au>
 */
class NullInputStream implements InputStream {

	/**
	 * @inheritdoc
	 */
	public function end() {
		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function read($count) {
		return '';
	}

}
 