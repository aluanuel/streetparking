<?php

namespace App\Http\Controllers;

use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use Bmatovu\MtnMomo\Products\Collection;
use Illuminate\Http\Request;

class TransactionController extends Controller {
	//
	public function paymomo(Request $request) {
		$totalprice = 1000;
		try {
			$collection = new Collection();

			$momoTransactionId = $collection->requestToPay('20201021002', '46733123453', $totalprice);
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
