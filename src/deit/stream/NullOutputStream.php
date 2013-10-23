<?php

namespace deit\stream;

/**
 * A null stream - a zero length stream with no contents
 * @author James Newell <james@digitaledgeit.com.au>
 */
class NullOutputStream implements OutputStream {

	/**
	 * @inheritdoc
	 */
	public function write($bytes, $count = null) {
		return $this;
	}

}
 