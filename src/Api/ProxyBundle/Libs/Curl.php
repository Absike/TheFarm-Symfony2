<?php

namespace Api\ProxyBundle\Libs;

class Curl
{
    /**
     * Send a GET requst using cURL
     * @param string $url to request
     * @param array $get values to send
     * @param array $options for cURL
     * @return string
     */
    public static function get($url, array $get = array())
    {
        $defaults = array(
            CURLOPT_URL => $url . (strpos($url, '?') === FALSE ? '?' : '') . http_build_query($get),
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT => 50,
        );

        $ch = curl_init();
        curl_setopt_array($ch, $defaults);
        if ( ! $result = curl_exec($ch)) {
            return 'Curl call error at ' . $url . ' : ' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    /**
     * Send a POST requst using cURL
     * @param string $url to request
     * @param array $post values to send
     * @return string
     */
    public static function post($url, array $post = array())
    {
        $ch = curl_init();

        $curlConfig = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 5000,
            CURLOPT_COOKIESESSION => TRUE,
            CURLOPT_CONNECTTIMEOUT => 0,
            /*CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($post)*/
        );

        curl_setopt_array($ch, $curlConfig);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

}
