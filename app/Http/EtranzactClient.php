<?php

namespace App\Http;

use App\Utils\Utility;

class EtranzactClient
{
  private static $ERR_RESPONSE = ['error' => 'No response.Service error!'];

  public static function getPayment(string $terminalId, string $confirmationCode) : array
  {
    /*$ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => "https://www.etranzact.net/WebConnectPlus/query.jsp?TERMINAL_ID=$terminalId&CONFIRMATION_NO=$confirmationCode",
      CURLOPT_RETURNTRANSFER => true
    ]);
    $output = curl_exec($ch);
    curl_close($ch);
    $output = urldecode($output);*/

      $output = urldecode("RECEIPT_NO=0701809211271390&PAYMENT_CODE=07025701271537524516222&MERCHANT_CODE=0701300039&TRANS_AMOUNT=40250.0&TRANS_DATE=2018/09/21 10:08:48&TRANS_DESCR=SCHOOL_FEE-2006131498-PETER%20NELSON&CUSTOMER_ID=2006131498&BANK_CODE=070&BRANCH_CODE=130&SERVICE_ID=2006131498&CUSTOMER_NAME=PETER%20NELSON%20ANDREW&CUSTOMER_ADDRESS=.&TELLER_ID=Ma.Okeke&USERNAME=N/A&PASSWORD=N/A&BANK_NAME=Fidelity%20Bank&BRANCH_NAME=NSUGBE%20BRANCH&CHANNEL_NAME=Bank&PAYMENT_METHOD_NAME=Cash&PAYMENT_CURRENCY=566&TRANS_TYPE=RCO1&TRANS_FEE=0.0&TYPE_NAME=SCHOOL_FEE&LEAD_BANK_CODE=070&LEAD_BANK_NAME=Fidelity%20Bank");
      /*$output = urldecode("RECEIPT_NO=0701809211271298&PAYMENT_CODE=07025701271537524516111&MERCHANT_CODE=0701300039&TRANS_AMOUNT=800.0&TRANS_DATE=2018/09/21 10:08:48&TRANS_DESCR=APPLICATION_FEE-86354555FF-OKEZIE%20CHIDIMMA&CUSTOMER_ID=86354555FF&BANK_CODE=070&BRANCH_CODE=130&SERVICE_ID=86354555FF&CUSTOMER_NAME=OKEZIE%20CHIDIMMA&CUSTOMER_ADDRESS=.&TELLER_ID=Ma.Okeke&USERNAME=N/A&PASSWORD=N/A&BANK_NAME=Fidelity%20Bank&BRANCH_NAME=NSUGBE%20BRANCH&CHANNEL_NAME=Bank&PAYMENT_METHOD_NAME=Cash&PAYMENT_CURRENCY=566&TRANS_TYPE=RCO1&TRANS_FEE=0.0&TYPE_NAME=APPLICATION_FEE&LEAD_BANK_CODE=070&LEAD_BANK_NAME=Fidelity%20Bank");*/

    if(Utility::contains('RECEIPT_NO=', $output))
    {
      $main = array_reduce(explode('&', $output), function ($arr, $str) {
        [$k, $v] = explode('=', $str);
        return array_merge($arr, [$k => $v]);
      }, []);
        $main['CONFIRMATION_NO'] = $confirmationCode;
        $main['TERMINAL_ID'] = $terminalId;
      return $main;
    }
    return self::$ERR_RESPONSE;
  }

}
