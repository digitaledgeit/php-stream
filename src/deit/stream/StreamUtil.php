<?php

namespace deit\stream;

/**
 * Stream utility
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
class StreamUtil {
	
	/**
	 * Copies data from one stream to another
	 * @param 	InputStream 	$in
	 * @param 	OutputStream 	$out
	 * @return 	void
	 */
	static public function copy(InputStream $in, OutputStream $out) {
		
		if ($in instanceof PhpInputStream && $out instanceof PhpOutputStream) {
			
			while (!$in->end()) stream_copy_to_stream($in->native(), $out->native());
			
		} else {
			
			while (!$in->end()) {
				$out->write($in->read(8192));
			}
			
		}
		
	}
	
}