<?php

namespace deit\stream;

/**
 * A PHP output stream opened by fopen, fsockopen or pfsockopen
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
trait PhpOutputStreamTrait {

	public function write($data, $count = null) {
		
		//make sure the stream is open
		$this->assertIsNotClosed();

		if (is_null($count)) {
			$count = strlen($data);
		}

		// --- write data to stream ---
		
		//TODO: use select_stream() to "sleep" if the first fwrite doesn't succeed??
		//TODO: allow non-blocking write
		
		for ($written=0; $written<$count; $written+=$fwrite) {
			if (($fwrite = fwrite($this->stream, substr($data, $written), $count)) === false) {
				throw new StreamException('Unable to write to stream.');
			}
		}
		
		return $this;
	}	
	
}