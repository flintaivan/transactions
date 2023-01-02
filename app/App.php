<?php

declare(strict_types = 1);



function checkFiles($dirName) {
	$files = [];
	$myFiles = array_diff(scandir($dirName), array('.', '..'));

	foreach ($myFiles as $file) {
		if(! $file) {
			return 'Error';
		}
		$files[] = $dirName . $file;
		return $files;
	}
}


function readFiles(string $data): array {
	$file = fopen($data, 'r');
	fgetcsv($file);
	$array = []; 

	while(($line = fgetcsv($file)) !== false) {
		$array[] = extractTransaction($line);
	}
	return $array;
	fclose($file);
}

function extractTransaction(array $transaction): array {
		[$date, $check, $description, $amount] = $transaction;

		$amount = (float) str_replace(['$', ','], '', $amount);
		return [
			'date'=>$date,
			'check'=>$check,
			'description'=>$description,
			'amount'=>$amount
		];
	}

function calculateTotals(array $transactions): array {
	$totals = [
		'totalIncome' => 0, 
		'totalExpense' => 0, 
		'netTotal' => 0
	];
	foreach ($transactions as $transaction) {
		$totals['netTotal'] += $transaction['amount'];

		if($transaction['amount'] >= 0) {
			$totals['totalIncome'] += $transaction['amount'];
		} else {
			$totals['totalExpense'] += $transaction['amount']; 
		}
	}

	return $totals;
}

