<?php

namespace deit\stream;

/**
 * A PHP output stream opened by fopen, fsockopen or pfsockopen
 * @author 	James Newell <james@digitaledgeit.com.au>
 */
class PhpOutputStream implements OutputStream, Blockable, Closeable, Seekable {
	use PhpOutputStreamTrait, PhpStreamTrait, PhpCloseableTrait, PhpBlockableTrait, PhpSeekableTrait;
}