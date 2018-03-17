<?php

class Simple_XMLRPC_Client {
	private $resource;
	private $username;
	private $password;

	public function __construct( $resource, $username = false, $password = false ) {
		$this->resource = $resource;
		$this->username = $username;
		$this->password = $password;
	}

	public function call( $method ) {
		// Get all arguments passed to this method, except the first which is assigned to method name.
		$args = func_get_args();
		array_shift( $args );

		$request = xmlrpc_encode_request( $method, $args );

		$connection = curl_init( $this->resource );

		curl_setopt_array( $connection, array(
			CURLOPT_RETURNTRANSFER => 1,                       // Return output as a string from curl_exec()
			CURLOPT_USERAGENT      => 'Simple XML-RPC Client',
			CURLOPT_POST           => 1,
			CURLOPT_POSTFIELDS     => $request
		) );

		$response  = curl_exec( $connection );
		$http_code = curl_getinfo( $connection, CURLINFO_HTTP_CODE );

		@curl_close( $connection );

		if ( empty( $response ) ) {
			throw new Exception( 'Received empty response' );
		} elseif ( 200 !== $http_code ) {
			throw new Exception( sprintf( 'Server replied with a non-200 code: %d', $http_code ), $http_code );
		}

		return xmlrpc_decode_request( $response, $method );
	}
}
