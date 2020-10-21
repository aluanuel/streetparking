<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientUssdController extends Controller {
	public static function session(Request $request) {
		//$request->all();
		$text = $request->input('text');
		$session_id = $request->input('sessionId');
		$phone_number = $request->input('phoneNumber');
		$service_code = $request->input('serviceCode');
		$network_code = $request->input('networkCode');
		$level = explode("*", $text);
		//if (isset($text)) {

		if ($text == "") {
			$response = "CON Welcome to the car ticketing system.\n What would you want to do\n";
			$response .= "1. Make ticket payment \n";
			$response .= "2. View unpaid tickets \n";
			$response .= "0. Exit";
		} else if (isset($level[0]) && $level[0] == 1 && !isset($level[1])) {
			$response = "CON Enter ticket number \n";
		} else if (isset($level[0]) && $level[0] == 1 && isset($level[1]) && !isset($level[2])) {
			$response = "CON Select a payment option.\n";
			$response .= "1. MTN Mobile Money \n";
			$response .= "2. Airtel Money";

		} else if (isset($level[0]) && $level[0] == 1 && isset($level[1]) && isset($level[2]) && $level[2] == 1 && !isset($level[3])) {

			// Session::put(['phoneNumber' => '$phone_number', 'totalPrice' => '1000']);

			// return Route::redirect('/paymomo', array('phoneNumber' => $phoneNumber, 'totalPrice' => '1000'));
			$response = "END Connecting to MTN servers \n";

		} else if (isset($level[0]) && $level[0] == 1 && isset($level[1]) && isset($level[2]) && $level[2] == 2 && !isset($level[3])) {

			$response = "END Connecting to Airtel servers \n";

		} else if (isset($level[0]) && $level[0] == 2 && !isset($level[1])) {

			$response = "CON Enter vehicle number plate \n";

		} else if (isset($level[0]) && $level[0] == 2 && isset($level[1])) {

			$response = "END No records found\n";

		} else if (isset($level[0]) && $level[0] == 0 && !isset($level[1])) {
			$response = "END Goodbye";
		} else {
			$response = "END Application not found";
		}
		header('Content-type: text/plain');
		echo $response;
		//}
	}

}
