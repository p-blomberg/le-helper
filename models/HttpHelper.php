<?php
class HttpHelper {
	public static function GET($url) {
		$c = curl_init($url);
		curl_setopt($c, CURLOPT_FAILONERROR, true);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($c, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
		$result = curl_exec($c);
		if($result === false) {
			throw new HttpException("curl_exec returned false");
		}
		curl_close($c);
		return $result;
	}
}
