<?php

namespace App\Models;

class CurlResponse
{
    public $log;
    public $url;
    public $access_token;
    private $startTime = null;
    private $shopcurl;
    private $result_array;

    function __construct() {
        $this->startTime = microtime(true);

        $this->result_array = array(
            'result'    => null,
            'message'   => null,
            'num_error'       => null,
        );
    }

    /**
     * Run curl request based on params and return the response
     * @param $req_url
     * @param bool $auth_required
     * @param string $method
     * @param null $fields
     * @return bool|string
     */
    public function getUrlResponse($req_url = '', $fields = null, $access_token = null) {

	if(strpos($req_url, "http") === false) $req_url = $this->url . $req_url;
        if($this->shopcurl == null) $this->shopcurl = curl_init();
        curl_reset($this->shopcurl);
        curl_setopt($this->shopcurl, CURLOPT_URL, $req_url);
        curl_setopt($this->shopcurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->shopcurl, CURLOPT_HEADER, 0);
        curl_setopt($this->shopcurl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->shopcurl, CURLOPT_ENCODING, '');
        curl_setopt($this->shopcurl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($this->shopcurl, CURLOPT_TIMEOUT_MS, 10000);

        try {
            $response = curl_exec ($this->shopcurl);
            $httpcode = curl_getinfo($this->shopcurl, CURLINFO_HTTP_CODE);

        } catch (Exception $e) {

            echo 'curlError';

        }
        return $this->returnResultArray($response,'success');

    }//getUrlResponse

    public function getUrlResponseHttpcode($req_url = '', $fields = null, $access_token = null) {

        try {

            $httpcode = curl_getinfo($this->shopcurl, CURLINFO_HTTP_CODE);

        } catch (Exception $e) {

            echo 'curlError';

        }

        return (int)$httpcode;
    }//getUrlResponse

    /**
     * Put the result params in array and return it
     * @param $result
     * @param $message
     * @param null $qty
     * @return array
     */
    private function returnResultArray($result, $message, $num_error = null) {
        $this->result_array['result'] = $result;
        $this->result_array['message'] = $message;
        $this->result_array['num_error'] = $num_error;

        return $this->result_array;
    }

    function __destruct() {
        if ($this->shopcurl!=null){
            try {
                curl_close($this->shopcurl);
            } catch (Exception $e) {

            }
        }

    }
}
