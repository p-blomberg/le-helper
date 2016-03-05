<?php
class ACMERequest {
	private $header;
	private $payload;
	private $signature;

	public function __construct($pubkey, $payload) {
		$this->header = json_encode([
			'typ' => 'JWT',
			'alg' => 'HS256',
			'jwk' => $pubkey,
		]);
		$this->payload = json_encode($payload);
	}

	public function get_payload() {
		return $this->payload;
	}

	public function encoded_header() {
		return self::base64url_encode($this->header);
	}
	public function encoded_payload() {
		return self::base64url_encode($this->payload);
	}
	private function encoded_signature() {
		return self::base64url_encode($this->signature);
	}

	public function get_signing_input() {
		return $this->encoded_header().'.'.$this->encoded_payload();
	}

	public function set_signature($signature) {
		$this->signature = $signature;
	}

	public function get_jws() {
		if(empty($this->signature)) {
			throw new Exception("Signature is not set");
		}
		return $this->encoded_header().'.'.
			$this->encoded_payload().'.'.
			$this->encoded_signature();
	}

	public static function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}
	public static function base64url_decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) + (strlen($data) % 4), '=', STR_PAD_RIGHT));
	}
}
