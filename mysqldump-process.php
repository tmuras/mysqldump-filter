#!/usr/bin/env php
<?php

/**
 * @copyright
 * @author
 * @license     The MIT License (MIT)
 */

require __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL);

use Symfony\Component\Console\Application;
use MysqldumpProcess\Analyze;

$application = new Application('mysqldump-process', '1.0');

$application->addCommands(array(
        new Analyze(),
));
$application->run();
