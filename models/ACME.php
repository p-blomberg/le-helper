<?php
class ACME {
	private $directory;

	public function __construct($directory_url) {
		$this->directory = json_decode(HttpHelper::GET($directory_url));
	}
}
