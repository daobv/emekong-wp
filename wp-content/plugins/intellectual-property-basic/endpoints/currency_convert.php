<?php

header( 'Content-Type: text/html; charset=utf-8' );

$price = intval( $_REQUEST['price'] );
$from_currency = $_REQUEST['from'];
$to_currency = $_REQUEST['to'];

$query = urlencode( $price . $from_currency . '=?' . $to_currency );

$ch = curl_init();

$url = "http://www.google.com/ig/calculator?hl=en&q=$query";

curl_setopt( $ch, CURLOPT_URL, $url );
curl_setopt( $ch, CURLOPT_HEADER, 0 ) ;
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

$data = curl_exec( $ch );

$response_array[] = explode( '"', $data );

$to_price = preg_replace( "/[^\da-z\s\.\,]/i", "", $response_array[0][3] );

echo $to_price;