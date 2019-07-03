<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const SANDBOX_HOST_URL = 'sandbox-utrust.com';
const PRODUCTION_HOST_URL = 'utrust.com';

/**
* WC_UTRUST_API_Base class.
*
* Sets Interfaces to Communicates with UTRUST API.
*/
class WC_UTRUST_API_Base {
	private $endpoint;

	/**
	* UTRUST API Endpoint
	*/
	public function __construct() {
		$utrust_settings = get_option( 'woocommerce_utrust_gateway_settings' );

		$host_url = ($utrust_settings['environment'] == "live") ? PRODUCTION_HOST_URL : SANDBOX_HOST_URL;

		$this->endpoint = 'https://merchants.api.' . $host_url . '/api/';
	}

	/**
	* POST API Request.
	*
	*/
	public function post_request( $request, $api, $headers = array() ) {

		$request  = apply_filters( 'woocommerce_utrust_request_body', $request, $api );

		$response = wp_remote_post(
			$this->endpoint . $api,
			array(
				'method'  => 'POST',
				'headers' => $headers,
				'body'    => $request,
				'timeout' => 70,
			)
		);

		if ( is_wp_error( $response ) || empty( $response['body'] ) ) {
			return 0;
		}

		return json_decode( $response['body'] );
	}

	public function add_order( $request, $api, $header ) {

		$curl = curl_init();

		curl_setopt_array( $curl, array(
		  CURLOPT_URL => $this->endpoint . $api,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode( $request ),
		  CURLOPT_HTTPHEADER => $header,
		) );

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		return $response;
	}

	/**
	* GET API Request.
	*
	*/
	public function get_request( $api ) {

		$response = wp_safe_remote_get(
			$this->endpoint . $api,
			array(
				'method'  => 'GET',
				'headers' => self::get_headers(),
				'timeout' => 70,
			)
		);

		if ( is_wp_error( $response ) || empty( $response['body'] ) ) {
			return 0;
		}

		return json_decode( $response['body'] );
	}
}
