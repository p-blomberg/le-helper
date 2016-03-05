#!/usr/bin/php
<?php

function out(...$msg) {
	foreach($msg as $m) {
		echo $m.PHP_EOL;
	}
}

function usage() {
	global $argv;
	out('Usage:', $argv[0]." <command> [options]");
	out('', 'Commands:');
	$longest = strlen('Commands: ');
	foreach(LeHelper::cmds() as $cmd) {
		if(strlen($cmd::name()) > $longest) {
			$longest = strlen($cmd::name());
		}
	}
	out(str_pad($cmd::name(), $longest+1, ' ').' '.$cmd::description());
}

$root = __DIR__;
require $root."/vendor/autoload.php";
require $root."/settings.php";
spl_autoload_register(function($classname) {
	global $root;
	$path = $root.'/models/'.$classname.'.php';
	if(file_exists($path)) {
		require $path;
	}
});

if($argc < 2) {
	usage();
	exit(1);
}

$args = $argv;
array_shift($args);
try {
	$cmd_string = array_shift($args);
	$cmd = LeHelper::getClass($cmd_string);
} catch(UnknownCommandException $e) {
	out("unknown command $cmd_string");
	exit(1);
}

$cmd = new $cmd;
$cmd->execute($args);
