<?php

namespace App\Http\Controllers;

use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use Bmatovu\MtnMomo\Products\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller {
	//
	public function paymomo(Request $request) {

		$totalprice = Session::get('totalPrice');

		$phone_number = Session::get('phoneNumber');
		
		// $momoTransactionId = NULL;
		try {
			$collection = new Collection();

			$momoTransactionId = $collection->requestToPay('20201021002', $phone_number, $totalprice);
		} catch (CollectionRequestException $e) {
			do {
				printf("\n\r%s:%d %s (%d) [%s]\n\r",
					$e->getFile(), $e->getLine(), $e->getMessage(), $e->getCode(), get_class($e));
			} while ($e = $e->getPrevious());
		}
		$response = $collection->getTransactionStatus($momoTransactionId);
		dd($response);
	}
}
