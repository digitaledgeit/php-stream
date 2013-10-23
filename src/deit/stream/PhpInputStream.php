<?php

namespace deit\stream;

/**
 * A PHP input stream opened by fopen, fsockopen or pfsockopen
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
class PhpInputStream implements InputStream, Blockable, Closeable, Seekable {
	use PhpInputStreamTrait, PhpStreamTrait, PhpCloseableTrait, PhpBlockableTrait, PhpSeekableTrait;
}