<?php

namespace deit\stream;

use Symfony\Component\Yaml\Exception\RuntimeException;

/**
 * ANSI output stream
 * @author 	James Newell <james@digitaledgeit.com.au>
 * @see http://softkube.com/blog/ansi-command-line-colors-under-windows/
 */
class AnsiOutputStream implements OutputStream {
	
	/**
	 * The colour names
	 */

	const COLOUR_DEFAULT    			= 'default';
	const COLOUR_BLACK 					= 'black';
	const COLOUR_RED 					= 'red';
	const COLOUR_GREEN 					= 'green';
	const COLOUR_YELLOW 				= 'yellow';
	const COLOUR_BLUE 					= 'blue';
	const COLOUR_MAGENTA 				= 'magenta';
	const COLOUR_CYAN 					= 'cyan';
	const COLOUR_WHITE 					= 'white';

	/*
	 * 	@see http://www.termsys.demon.co.uk/vtansi.htm
	 */
	
	/**
	 * The foreground colours
	 * @var 	int[string]
	 */
	static private $foregroundAttributes 	= array(
		self::COLOUR_DEFAULT    => '39',
		self::COLOUR_BLACK 		=> '30',
		self::COLOUR_RED 		=> '31',
		self::COLOUR_GREEN 		=> '32',
		self::COLOUR_YELLOW 	=> '33',
		self::COLOUR_BLUE 		=> '34',
		self::COLOUR_MAGENTA 	=> '35',
		self::COLOUR_CYAN 		=> '36',
		self::COLOUR_WHITE 		=> '37',
	);
	
	/**
	 * The background colours
	 * @var 	int[string]
	 */
	static private $backgroundAttributes 	= array(
		self::COLOUR_DEFAULT    => '49',
		self::COLOUR_BLACK 		=> '40',
		self::COLOUR_RED 		=> '41',
		self::COLOUR_GREEN 		=> '42',
		self::COLOUR_YELLOW 	=> '43',
		self::COLOUR_BLUE 		=> '44',
		self::COLOUR_MAGENTA 	=> '45',
		self::COLOUR_CYAN 		=> '46',
		self::COLOUR_WHITE 		=> '47'
	);

	/**
	 * Whether ANSI codes are supported
	 * @var     bool
	 */
	private $ansi;

	/**
	 * The output stream
	 * @var 	OutputStream
	 */
	private $stream;
	
	/**
	 * The foreground colour
	 * @var 	string
	 */
	private $foreground = self::COLOUR_DEFAULT;

	/**
	 * The background colour
	 * @var 	string
	 */
	private $background = self::COLOUR_DEFAULT;

	/**
	 * Constructs the writer
	 * @param 	OutputStream $stream
	 */
	public function __construct(OutputStream $stream) {
		$this->ansi     = (DIRECTORY_SEPARATOR == '\\' && getenv('ANSICON') !== false) || (function_exists('posix_isatty') && posix_isatty(STDOUT));
		$this->stream   = $stream;
	}

	/**
	 * Clears all styling to the default
	 * @return  $this
	 */
	public function reset() {
		if ($this->ansi) {
			$this->stream->write("\033[0m");
			$this->foreground = self::COLOUR_DEFAULT;
			$this->background = self::COLOUR_DEFAULT;
		}
		return $this;
	}

	/**
	 * Sets the foreground colour
	 * @param 	string  $colour 	The colour
	 * @return 	string              The previous colour
	 * @throws  \InvalidArgumentException
	 */
	public function fg($colour) {

		//check the colour exists
		if (!isset(self::$foregroundAttributes[$colour])) {
			throw new \InvalidArgumentException("Unsupported foreground colour `$colour`.");
		}

		//get the previous foreground colour
		$previous = $this->foreground;

		//set the foreground colour
		$this->foreground = $colour;

		return $previous;
	}

	/**
	 * Sets the background colour
	 * @param 	string  $colour 	The colour
	 * @return 	string              The previous colour
	 * @throws  \InvalidArgumentException
	 */
	public function bg($colour) {

		//check the colour exists
		if (!isset(self::$backgroundAttributes[$colour])) {
			throw new \InvalidArgumentException("Unsupported background colour `$colour`.");
		}

		//get the previous background colour
		$previous = $this->background;

		//set the background colour
		$this->background = $colour;

		return $previous;
	}
	
	/**
	 * Sets the current text style blinking
	 * @param 	bool $blink
	 * @return 	AnsiOutputStream
	 */
	public function blink($blink) {
	}
	
	/**
	 * Sets the current style underlined
	 * @param 	bool $underline
	 * @return 	AnsiOutputStream
	 */
	public function underline($underline) {
	}

	/**
	 * @inheritdoc
	 */
	public function write($bytes, $count = null) {

		if ($this->ansi) {

			$prefix = "\033[".self::$foregroundAttributes[$this->foreground].";".self::$backgroundAttributes[$this->background]."m";
			$suffix = "\033[0m";

			$output = $prefix.$bytes.$suffix;

		} else {
			$output = $bytes;
		}

		//FIXME: count argument shouldn't consider escape codes, implement that within this class by updating count by the # of escape characters inserted before count characters
		if (!is_null($count)) throw new RuntimeException('Count is not supported at this time');
		$this->stream->write($output, $count);
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function writeln($bytes, $count = null) {
		$this->stream->write($bytes.PHP_EOL, $count);
		return $this;
	}

}