<?php

namespace App\Http\Controllers;

class ClientUssdController extends Controller {
	//
	public function index() {
		// Reads the variables sent via POST from our gateway
		$sessionId = Input::get('sessionId');
		$serviceCode = Input::get('serviceCode');
		$phoneNumber = Input::get('phoneNumber');
		$text = Input::get('text');
		$level = explode("*", $text);

		if ($text == "") {
			// This is the first request. Note how we start the response with CON
			$response = "CON Welcome to the car ticketing system.\n What would you want to do\n";
			$response .= "1. Make ticket payment \n";
			$response .= "2. View unpaid tickets";

		} else if ($text == "1") {
			// Business logic for first level response
			$response = "CON Enter ticket number \n";
		} else if ($text == "1*" . $level[1]) {
			// This is a second level response where the user selected 1 in the first instance
			$response = "CON Select a payment option.\n";
			$response .= "1. MTN Mobile Money \n";
			$response .= "2. Airtel Money";
			//$accountNumber  = "Ticket is ".$level[1];

			// This is a terminal request. Note how we start the response with END
			//$response = "END Your account number is ".$accountNumber;

		} else if ($text == "1*" . $level[1] . "*1") {

			$response = "END Connecting to MTN server\nTo be continued... ";

		} else if ($text == "1*" . $level[1] . "*2") {

			$response = "END Connecting to Airtel server\nTo be continued... ";

		} else if ($text == "2") {
			// Business logic for first level response
			// This is a terminal request. Note how we start the response with END
			$response = "CON Enter vehicle number plate \n";
		} else if ($text == "2*" . $level[1]) {

			$response = "END 12345\t 31/12/2020 \t ARUA\t ";

		}

		// Echo the response back to the API
		header('Content-type: text/plain');
		echo $response;

		return $response;
	}

}
