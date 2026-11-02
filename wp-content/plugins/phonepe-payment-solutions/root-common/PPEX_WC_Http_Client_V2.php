<?php

/**
 * PPEX_WC_Http_Client_V2
 */

use PhonePe\common\exceptions\PhonePeException;
use PhonePe\common\utils\HttpResponse;

if (!class_exists('PPEX_WC_Http_Client_V2')) {
	class PPEX_WC_Http_Client_V2 {

		/**
		 * @param PPEX_Api_Request
		 * @return PPEX_Api_Response
		 */

		public static function getRequest($url, $headers) {
			$modified_headers = self::modifyMandatoryHeaders($headers);
			$args = array(
				'headers'     => $modified_headers,
			);

			ppLogInfo("[PhonePe HTTP] GET " . $url);
			$response = wp_remote_get($url, $args);

			if (is_wp_error($response)) {
				$wp_error_msg = $response->get_error_message();
				$wp_error_code = $response->get_error_code();
				ppLogError("[PhonePe HTTP] GET network error | url: " . $url . " | wp_error_code: " . $wp_error_code . " | wp_error_message: " . $wp_error_msg);
				throw new PhonePeException("Network error: " . $wp_error_msg, 0, "NETWORK_ERROR", null);
			}

			$http_code = wp_remote_retrieve_response_code($response);
			$raw_body = wp_remote_retrieve_body($response);
			$body = json_decode($raw_body, true);
		
			// Only log response body for successful calls without sensitive data
			ppLogInfo("[PhonePe HTTP] GET response | url: " . $url . " | http_code: " . $http_code);

			$httpResponse = new HttpResponse();
			$httpResponse->setResponse(json_encode($body));

			if ($http_code == 200)
				return $httpResponse;
			else {
				// Log full response body only on failure for debugging
				ppLogError("[PhonePe HTTP] GET failed | url: " . $url . " | http_code: " . $http_code . " | body: " . self::sanitizeResponseForLogging($raw_body, $url));
				throw new PhonePeException($body['message'] ?? "Unknown error", $http_code, $body['code'] ?? null, $body['data'] ?? null);
			}
		}

		/**
		 * @param PPEX_Api_Request
		 * @return PPEX_Api_Response
		 */

		public static function postRequest($url, $body, $headers) {
			$is_oauth = strpos($url, "/oauth/token") !== false;
			if ($is_oauth) {
				$modified_headers = $headers;
			} else {
				$modified_headers = self::modifyMandatoryHeaders($headers);
				// UAT sandbox rejects "metaInfo":[] (empty JSON array) but PROD accepts it.
				// The SDK serializes an empty MetaInfo as [] instead of {}.
				// Replace any empty metaInfo array with an empty object before sending.
				if (is_string($body)) {
					$body = str_replace('"metaInfo":[]', '"metaInfo":{}', $body);
				}
			}

			$args = array(
				'headers'     => $modified_headers,
				'body'        => $body,
			);

			ppLogInfo("[PhonePe HTTP] POST " . $url . ($is_oauth ? " [oauth]" : ""));
			$response = wp_remote_post($url, $args);

			if (is_wp_error($response)) {
				$wp_error_msg = $response->get_error_message();
				$wp_error_code = $response->get_error_code();
				ppLogError("[PhonePe HTTP] POST network error | url: " . $url . " | wp_error_code: " . $wp_error_code . " | wp_error_message: " . $wp_error_msg);
				throw new PhonePeException("Network error: " . $wp_error_msg, 0, "NETWORK_ERROR", null);
			}

			$http_code = wp_remote_retrieve_response_code($response);
			$raw_body = wp_remote_retrieve_body($response);
			$body = json_decode($raw_body, true);
		
			// Only log response body for successful calls without sensitive data
			ppLogInfo("[PhonePe HTTP] POST response | url: " . $url . " | http_code: " . $http_code);

			$httpResponse = new HttpResponse();
			$httpResponse->setResponse(json_encode($body));

			if ($http_code == 200)
				return $httpResponse;
			else {
				// Log full response body only on failure for debugging
				ppLogError("[PhonePe HTTP] POST failed | url: " . $url . " | http_code: " . $http_code . " | body: " . self::sanitizeResponseForLogging($raw_body, $url));
				throw new PhonePeException($body['message'] ?? "Unknown error", $http_code, $body['code'] ?? null, $body['data'] ?? null);
			}
		}

		public static function modifyMandatoryHeaders($headers){
			$modified_headers = array();
			$modified_headers['X-SOURCE'] = PPEX_PG_Constants::PLUGIN_SOURCE_HEADER;
			$modified_headers['X-SOURCE-VERSION'] = B2BPG_WOOCOMMERCE_PLUGIN_VERSION;
			$modified_headers['X-SOURCE-PLATFORM'] = PPEX_PG_Constants::WOOCOMMERCE;
			$modified_headers['X-SOURCE-PLATFORM-VERSION'] = WOOCOMMERCE_VERSION;
			$modified_headers['X-MERCHANT-DOMAIN'] = esc_url(site_url());
			$modified_headers['X-SOURCE-CLIENT-BROWSER-FINGERPRINT'] = ($_COOKIE['browserFingerprint']) ?? "DEFAULT";
			$modified_headers['accept'] = $headers['accept'] ?? "application/json";
			$modified_headers['Content-Type'] = $headers['Content-Type'];
			$modified_headers['Authorization'] = $headers['Authorization'];
			return $modified_headers;
		}

		/**
		 * Sanitize response body for logging by redacting sensitive information.
		 * Prevents token leakage and PII exposure in logs.
		 * 
		 * @param string $raw_body The raw response body
		 * @param string $url The request URL (to detect oauth endpoints)
		 * @return string Sanitized response body safe for logging
		 */
		private static function sanitizeResponseForLogging($raw_body, $url) {
			// For oauth/token endpoints, redact the entire response to prevent token leakage
			if (strpos($url, '/oauth/token') !== false) {
				return '[REDACTED: OAuth token response]';
			}

			$body = json_decode($raw_body, true);
			if (!is_array($body)) {
				return $raw_body; // Return as-is if not valid JSON
			}

			// Redact sensitive fields
			$sensitive_fields = [
				'access_token',
				'refresh_token',
				'encrypted_access_token',
				'accountHolderName',
				'maskedAccountNumber',
				'vpa',
				'utr',
				'upiTransactionId',
				'ifsc'
			];

			foreach ($sensitive_fields as $field) {
				if (isset($body[$field])) {
					$body[$field] = '[REDACTED]';
				}
			}

			// Recursively redact nested structures (e.g., paymentDetails array)
			array_walk_recursive($body, function(&$value, $key) use ($sensitive_fields) {
				if (in_array($key, $sensitive_fields)) {
					$value = '[REDACTED]';
				}
			});

			return json_encode($body);
		}
	}
}
