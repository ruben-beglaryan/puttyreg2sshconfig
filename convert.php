#!/usr/bin/php
<?php
$count = 0;
define('REG_PATH', '[HKEY_CURRENT_USER\Software\Simontatham\PuTTY\Sessions\\');
$mapper = array(
	'HostName' => 'Hostname',
	'UserName' => 'User',
);

$result = array();

$currentElement = false;
while ($line  = fgets(STDIN)) {
	$line = trim($line);

	if (strpos($line, REG_PATH) !== false) {
		if ($line == REG_PATH . 'Default%20Settings]') {
			continue;
		}
		if ($currentElement) {
			$result[] = $currentElement;
		}
		$currentElement = array(
			'Host' => str_replace(array(
				REG_PATH, ']'
			), '', $line)
		);
		continue;
	}
	if ($currentElement) {
		foreach ($mapper as $old => $new) {
			if (strpos($line, '"' . $old . '"') !== false) {
				if ($value = str_replace(array($old, '"', '='), '', $line)) {
					$currentElement[$new] = $value;
				}
				continue;
			}
		}
	}
}


foreach ($result as $entry) {
	foreach ($entry as $key => $value) {
		fwrite(STDOUT, $key . ' ' . $value . PHP_EOL);
	}
	fwrite(STDOUT, PHP_EOL);
	fwrite(STDOUT, PHP_EOL);
}




