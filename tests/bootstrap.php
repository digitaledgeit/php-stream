<?php

$autoloader = require_once __DIR__.'/../vendor/autoload.php';
$autoloader->add('deit\\stream', [ __DIR__.'/../src', __DIR__.'/../tests' ]);
