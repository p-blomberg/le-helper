<?php
class NewReg extends Command {
	public static function name() {
		return "new-reg";
	}
	public static function description() {
		return "Create a new account with LE";
	}
	public static function help() {
		global $argv;
		out('Usage:', $argv[0]." new-reg <email>");
	}
	public function execute($args) {
		if(count($args) !== 1 || $args[0] == "--help") {
			return self::help();
		}
		$email = $args[0];

		throw new Exception("TODO: ask for pubkey");
		// or maybe the syntax should be le.php new-reg derp@foo.bar /path/to/foobar.pub ?
		throw new Exception("TODO: encode pubkey as JWK");
		// https://tools.ietf.org/html/rfc7517#section-3

		$request = new ACMERequest(
			$pubkey,
			[
				"resource" => "new-reg",
				"contact" => [
					"mailto:".$email,
				],
			]
		);
		out('This request will be sent to LE:');
		out($request->get_payload());
		out('Please sign this request:');
		out('echo -n "'.$request->get_signing_input().'" | openssl sha256 -hex -sign FOOBAR.key');
		out('Paste the output from openssl here and press ctrl+d when done.');

		$result = '';
		$stdin = fopen('php://stdin', 'r');
		while(!feof($stdin)) {
			$result .= fread($stdin, 2048);
		}
		fclose($stdin);

		out("got ".strlen($result).' bytes');

		throw new Exception("Not done with this crap");
		/*
		global $settings;
		$acme = new ACME($settings['directory_url']);
		*/
	}
}
