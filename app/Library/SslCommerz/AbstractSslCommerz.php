<?php

namespace App\Library\SslCommerz;

abstract class AbstractSslCommerz implements SslCommerzInterface
{
    protected $apiUrl;
    protected $storeId;
    protected $storePassword;

    protected function setStoreId($storeID)
    {
        $this->storeId = $storeID;
    }

    protected function getStoreId()
    {
        return $this->storeId;
    }

    protected function setStorePassword($storePassword)
    {
        $this->storePassword = $storePassword;
    }

    protected function getStorePassword()
    {
        return $this->storePassword;
    }

    protected function setApiUrl($url)
    {
        $this->apiUrl = $url;
    }

    protected function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param $data
     * @param array $header
     * @param bool $setLocalhost
     * @return bool|string
     */
    // public function callToApi($data, $header = [], $setLocalhost = false)
    // {
    //     $curl = curl_init();

    //     if (!$setLocalhost) {
    //         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    //         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // The default value for this option is 2. It means, it has to have the same name in the certificate as is in the URL you operate against.
    //     } else {
    //         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    //         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // When the verify value is 0, the connection succeeds regardless of the names in the certificate.
    //     }

    //     curl_setopt($curl, CURLOPT_URL, $this->getApiUrl());
    //     curl_setopt($curl, CURLOPT_HEADER, 0);
    //     curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    //     curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    //     curl_setopt($curl, CURLOPT_POST, 1);
    //     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    //     $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    //     $curlErrorNo = curl_errno($curl);
    //     curl_close($curl);

    //     if ($code == 200 & !($curlErrorNo)) {
    //         return $response;
    //     } else {
    //         return "FAILED TO CONNECT WITH SSLCOMMERZ API";
    //         //return "cURL Error #:" . $err;
    //     }
    // }





    public function callToApi($data, $header = [], $setLocalhost = false)
    {
        $curl = curl_init();

        // SSL verification settings
        if (!$setLocalhost) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_CAINFO, 'D:\\laragon\\etc\\ssl\\cacert.pem'); // Ensure the path is correct
        } else {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        }

        curl_setopt($curl, CURLOPT_URL, $this->getApiUrl());
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        // Execute the cURL request
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlErrorNo = curl_errno($curl);

        // Close the cURL session
        curl_close($curl);  

        // Check for successful response
        if ($code >= 200 && $code < 300 && $curlErrorNo === 0) {
           
            return json_decode($response, true); // Assuming API returns JSON
        } else {
            // Prepare detailed error information
            $errorMessage = [
                'HTTP Code' => $code,
                'cURL Error No' => $curlErrorNo,
                'cURL Error' => $err,
                'Response' => $response,
            ];
            return "FAILED TO CONNECT WITH SSLCOMMERZ API: " . json_encode($errorMessage);
        }
    }






    /**
     * @param $response
     * @param string $type
     * @param string $pattern
     * @return false|mixed|string
     */
    public function formatResponse($response, $type = 'checkout', $pattern = 'json')
    {
        if (is_array($response)) {
            $sslcz = $response;
        } else {
            $sslcz = json_decode($response, true);
        }

        if ($type != 'checkout') {
            return $sslcz;
        } else {
            if (!empty($sslcz['GatewayPageURL'])) {
                // this is important to show the popup, return or echo to send json response back
                if (!empty($this->getApiUrl()) && $this->getApiUrl() == 'https://securepay.sslcommerz.com') {
                    $response = json_encode(['status' => 'SUCCESS', 'data' => $sslcz['GatewayPageURL'], 'logo' => $sslcz['storeLogo']]);
                } else {
                    $response = json_encode(['status' => 'success', 'data' => $sslcz['GatewayPageURL'], 'logo' => $sslcz['storeLogo']]);
                }
            } else {
                if (strpos($sslcz['failedreason'], 'Store Credential') === false) {
                    $message = $sslcz['failedreason'];
                } else {
                    $message = "Check the SSLCZ_TESTMODE and SSLCZ_STORE_PASSWORD value in your .env; DO NOT USE MERCHANT PANEL PASSWORD HERE.";
                }
                $response = json_encode(['status' => 'fail', 'data' => null, 'message' => $message]);
            }

            if ($pattern == 'json') {
                return $response;
            } else {
                echo $response;
            }
        }
    }

    /**
     * @param $url
     * @param bool $permanent
     */
    public function redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);

        exit();
    }
}
