<?php

require_once __DIR__.'/bootstrap.php';

$stream = new deit\stream\AnsiOutputStream(new deit\stream\PhpOutputStream(STDOUT, false));

$stream->fg('red');
$stream->bg('green');
$stream->write("Its not long till Christmas now!");

$stream->fg('white');
$stream->bg('red');
$stream->write("\n\n\tException: Uh-oh! Something went wrong!!!\n\n");
$stream->reset();