<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

/* YOUR CODE (Instructions in README.md) */

include(APP_PATH . 'App.php');
require(APP_PATH . 'helper.php');

//$files = getTransactionFiles(FILES_PATH);
//var_dump($files);

$filesChecked = checkFiles(FILES_PATH);


foreach ($filesChecked as $file) {
	echo "<pre>";
	$transactions = readFiles($file);
	echo "</pre>";
	$totals = calculateTotals($transactions);
}



require VIEWS_PATH . 'transactions.php';
