<?php
class LeHelper {
	private static $cmds = [
			"new-reg" => "NewReg",
			"help"    => "Help",
			"--help"  => "Help",
			"-h"      => "Help",
			"--usage" => "Help",
		];

	public static function cmds() {
		return self::$cmds;
	}
	public static function getClass($cmd) {
		if(isset(self::$cmds[$cmd])) {
			return self::$cmds[$cmd];
		}
		throw new UnknownCommandException();
	}
}
