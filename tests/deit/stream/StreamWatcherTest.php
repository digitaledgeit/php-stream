<?php

namespace deit\stream;

/**
 * Stream watcher test
 * @author James Newell <james@digitaledgeit.com.au>
 */
class StreamWatcherTest extends \PHPUnit_Framework_TestCase {

	public function test_watch() {

		$watcher = new StreamWatcher();
		$watcher->register(new FileInputStream(__FILE__), StreamWatcher::OP_READ);

		$changed = $watcher->watch();

		$this->assertEquals(1, count($changed));
		$this->assertEquals(StreamWatcher::OP_READ, $changed[0]->getReadyOperations());
		$this->assertTrue(strlen($changed[0]->getStream()->read(10)) > 0);

	}

}
 